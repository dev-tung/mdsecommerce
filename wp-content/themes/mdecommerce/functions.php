<?php
if (!defined('ABSPATH')) exit;

function mdecommerce_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mdecommerce_setup');
