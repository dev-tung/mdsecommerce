<?php
defined('ABSPATH') || exit;
get_header();
?>

<div class="container my-4 p-3 bg-white">

    <?php
    if (!class_exists('WooCommerce')) {
        echo 'Chưa bật WooCommerce';
    } else {
        echo do_shortcode('[woocommerce_cart]');
    }
    ?>

</div>

<?php get_footer(); ?>
