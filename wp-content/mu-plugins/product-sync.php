<?php
/*
Plugin Name: POS Sync (MU)
Description: Sync products & categories from POS API to WooCommerce
*/

if (!defined('ABSPATH')) {
    exit;
}

class ProductSync
{
    const META_POS_ID       = '_pos_product_id';
    const META_POS_GROUP    = '_pos_group_name';
    const API_URL = 'https://manhdungsports.io.vn/api/product/list';

    public function __construct()
    {
        add_action('admin_init', [$this, 'handle_manual_sync']);
    }

    /* =============================
     * PUBLIC METHODS
     * ============================= */

    public function sync_products()
    {
        $response = $this->get_products_from_api();

        if (
            empty($response) ||
            empty($response['success']) ||
            empty($response['data'])
        ) {
            return false;
        }

        foreach ($response['data'] as $item) {
            $post_id = $this->get_product_by_pos_id($item['id']);

            if (!$post_id) {
                $post_id = $this->create_product($item);
            } else {
                $this->update_product($post_id, $item);
            }

            $this->update_price($post_id, $item);
            $this->sync_category($post_id, $item);
        }

        return true;
    }

    /* =============================
     * INTERNAL
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

    private function create_product($item)
    {
        $post_id = wp_insert_post([
            'post_title'   => $item['name'] ?? 'Không tên',
            'post_type'    => 'product',
            'post_status'  => ($item['status'] ?? '') === 'active' ? 'publish' : 'draft',
            'post_content' => $item['description'] ?? '',
        ]);

        if (is_wp_error($post_id)) {
            return 0;
        }

        wp_set_object_terms($post_id, 'simple', 'product_type');
        update_post_meta($post_id, self::META_POS_ID, $item['id']);

        return $post_id;
    }

    private function update_product($post_id, $item)
    {
        wp_update_post([
            'ID'           => $post_id,
            'post_title'   => $item['name'] ?? 'Không tên',
            'post_content' => $item['description'] ?? '',
            'post_status'  => ($item['status'] ?? '') === 'active' ? 'publish' : 'draft',
        ]);
    }

    /**
     * Sync CATEGORY bằng NAME + lưu meta
     */
    private function sync_category($post_id, $item)
    {
        if (empty($item['group_name'])) {
            return;
        }

        $group_name = trim((string) $item['group_name']);

        // Chặn tuyệt đối numeric
        if ($group_name === '' || is_numeric($group_name)) {
            return;
        }

        // 🔥 XOÁ TOÀN BỘ category cũ (kể cả t37)
        wp_set_object_terms($post_id, [], 'product_cat');

        // ✅ Gán lại bằng TÊN
        wp_set_object_terms($post_id, [$group_name], 'product_cat');

        // Lưu meta debug
        update_post_meta($post_id, self::META_POS_GROUP, $group_name);
    }


    private function update_price($post_id, $item)
    {
        $product = wc_get_product($post_id);
        if (!$product) return;

        $regular = $item['price'] ?? '';
        $sale    = $item['sale_price'] ?? '';

        $product->set_regular_price($regular);
        $product->set_sale_price($sale ?: '');
        $product->set_price($sale ?: $regular);
        $product->save();
    }

    private function get_products_from_api()
    {
        $response = wp_remote_get(self::API_URL, ['timeout' => 20]);

        if (is_wp_error($response)) {
            return [];
        }

        return json_decode(wp_remote_retrieve_body($response), true) ?: [];
    }

    /**
     * Trigger sync bằng URL:
     * /wp-admin/?pos_sync=run
     */
    public function handle_manual_sync()
    {
        if (
            !current_user_can('manage_options') ||
            ($_GET['pos_sync'] ?? '') !== 'run'
        ) {
            return;
        }

        $this->sync_products();
        wp_die('POS Sync done!');
    }
}

new ProductSync();
