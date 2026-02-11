<?php
defined('ABSPATH') || exit;
get_header();
?>

<div class="container my-4 p-3 bg-white">
    <?php echo do_shortcode('[woocommerce_checkout]'); ?>
</div>

<?php get_footer(); ?>
