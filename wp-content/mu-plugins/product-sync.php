<?php
/*
Plugin Name: POS Sync (MU)
Description: Sync products from POS API to WooCommerce
*/

if (!defined('ABSPATH')) exit;

class ProductSync
{
    const META_POS_ID    = '_pos_product_id';
    const META_POS_GROUP = '_pos_group_name';

    const API_URL = 'https://manhdungsports.io.vn/job/inventory-website';

    public function __construct()
    {
        add_action('admin_init', [$this, 'handle_manual_sync']);
    }

    /* =============================
     * MAIN
     * ============================= */

    public function sync_products()
    {
        $data = $this->get_products_from_api();
        if (empty($data['data'])) return;

        foreach ($data['data'] as $item) {

            $post_id = $this->get_product_by_pos_id($item['product_id']);

            $post_id
                ? $this->update_product($post_id, $item)
                : $post_id = $this->create_product($item);

            if (!$post_id) continue;

            $this->sync_price_stock($post_id, $item);
            $this->sync_category($post_id, $item);
        }
    }

    /* =============================
     * STATUS LOGIC (CORE)
     * ============================= */

    private function resolve_status($qty)
    {
        if ($qty <= 0) return 'private'; // ẨN WEBSITE
        return 'publish';               // CÒN HÀNG
    }

    /* =============================
     * PRODUCT
     * ============================= */

    private function create_product($item)
    {
        $qty = (int) ($item['quantity'] ?? 0);

        $post_id = wp_insert_post([
            'post_type'   => 'product',
            'post_title'  => $item['name'] ?? 'Không tên',
            'post_status' => $this->resolve_status($qty),
        ]);

        if (is_wp_error($post_id)) return 0;

        wp_set_object_terms($post_id, 'simple', 'product_type');
        update_post_meta($post_id, self::META_POS_ID, $item['product_id']);

        return $post_id;
    }

    private function update_product($post_id, $item)
    {
        $qty = (int) ($item['quantity'] ?? 0);

        wp_update_post([
            'ID'          => $post_id,
            'post_title'  => $item['name'] ?? 'Không tên',
            'post_status' => $this->resolve_status($qty),
        ]);
    }

    /* =============================
     * PRICE + STOCK
     * ============================= */

    private function sync_price_stock($post_id, $item)
    {
        $product = wc_get_product($post_id);
        if (!$product) return;

        $qty   = (int) ($item['quantity'] ?? 0);
        $price = $item['price'] ?? '';
        $sale  = $item['sale_price'] ?? '';

        $product->set_regular_price($price);
        $product->set_sale_price($sale ?: '');
        $product->set_price($sale ?: $price);

        $product->set_manage_stock(true);
        $product->set_stock_quantity(max(0, $qty));
        $product->set_stock_status($qty > 0 ? 'instock' : 'outofstock');

        $product->save();
    }

    /* =============================
     * CATEGORY
     * ============================= */

    private function sync_category($post_id, $item)
    {
        if (empty($item['product_group_name'])) return;

        $name = trim($item['product_group_name']);
        if ($name === '' || is_numeric($name)) return;

        wp_set_object_terms($post_id, [], 'product_cat');
        wp_set_object_terms($post_id, [$name], 'product_cat');

        update_post_meta($post_id, self::META_POS_GROUP, $name);
    }

    /* =============================
     * HELPERS
     * ============================= */

    private function get_product_by_pos_id($pos_id)
    {
        global $wpdb;
        return $wpdb->get_var($wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta}
             WHERE meta_key = %s AND meta_value = %s",
            self::META_POS_ID,
            $pos_id
        ));
    }

    private function get_products_from_api()
    {
        $res = wp_remote_get(self::API_URL, ['timeout' => 20]);
        if (is_wp_error($res)) return [];

        return json_decode(wp_remote_retrieve_body($res), true) ?: [];
    }

    /* =============================
     * MANUAL TRIGGER
     * ============================= */

    public function handle_manual_sync()
    {
        if (!current_user_can('manage_options')) return;
        if (($_GET['pos_sync'] ?? '') !== 'run') return;

        $this->sync_products();
        wp_die('✅ POS Sync done');
    }
}

new ProductSync();
