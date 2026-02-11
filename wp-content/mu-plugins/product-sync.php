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

    const API_URL   = 'https://manhdungsports.io.vn/job/inventory-website';
    const SECRET_KEY = 'manhdungsports123'; // 🔐 đổi key này

    public function __construct()
    {
        add_action('init', [$this, 'handle_manual_sync']);
    }

    /* =============================
     * TRIGGER (NO LOGIN)
     * ============================= */

    public function handle_manual_sync()
    {
        if (($_GET['pos_sync'] ?? '') !== 'run') return;
        if (($_GET['key'] ?? '') !== self::SECRET_KEY) {
            status_header(403);
            echo '❌ Unauthorized';
            exit;
        }

        $result = $this->sync_products();

        if (is_wp_error($result)) {
            status_header(500);
            echo $result->get_error_message();
            exit;
        }

        echo '✅ POS Sync done';
        exit;
    }

    /* =============================
     * MAIN
     * ============================= */

    public function sync_products()
    {
        $data = $this->get_products_from_api();

        if (is_wp_error($data)) {
            return $data;
        }

        foreach ($data['data'] as $item) {

            if (empty($item['product_id'])) {
                return new WP_Error(
                    'invalid_item',
                    '❌ Thiếu product_id'
                );
            }

            $post_id = $this->get_product_by_pos_id($item['product_id']);

            if ($post_id) {
                $this->update_product($post_id, $item);
            } else {
                $post_id = $this->create_product($item);
            }

            if (!$post_id) {
                return new WP_Error(
                    'sync_failed',
                    '❌ Không thể sync sản phẩm: ' . ($item['name'] ?? '')
                );
            }

            $this->sync_price_stock($post_id, $item);
            $this->sync_category($post_id, $item);
        }

        return true;
    }

    /* =============================
     * STATUS
     * ============================= */

    private function resolve_status($qty)
    {
        return ($qty <= 0) ? 'private' : 'publish';
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

        wp_set_object_terms($post_id, [$name], 'product_cat', false);
        update_post_meta($post_id, self::META_POS_GROUP, $name);
    }

    /* =============================
     * HELPERS
     * ============================= */

    private function get_product_by_pos_id($pos_id)
    {
        global $wpdb;

        return $wpdb->get_var(
            $wpdb->prepare(
                "SELECT post_id FROM {$wpdb->postmeta}
                 WHERE meta_key = %s AND meta_value = %s",
                self::META_POS_ID,
                $pos_id
            )
        );
    }

    private function get_products_from_api()
    {
        $res = wp_remote_get(self::API_URL, ['timeout' => 20]);

        if (is_wp_error($res)) {
            return new WP_Error(
                'api_error',
                '❌ Không gọi được API: ' . $res->get_error_message()
            );
        }

        $json = json_decode(wp_remote_retrieve_body($res), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new WP_Error('json_error', '❌ JSON không hợp lệ');
        }

        if (empty($json['data'])) {
            return new WP_Error('empty_data', '⚠️ API không có dữ liệu');
        }

        return $json;
    }
}

new ProductSync();
