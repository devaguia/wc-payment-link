<?php
/**
 * template: wp-content/plugins/wc-plugin-template/app/Views/Pages/checkout/index.php
 */
?>

<?php get_header(); ?>

<div>
    <?php wc_print_notices(); ?>
    <div class="woocommerce">
        <?php echo do_shortcode('[woocommerce_checkout]'); ?>
    </div>
</div>

<?php get_footer(); ?>