<?php
/**
 * GreenPure CBD — Fiche produit individuelle
 */
defined('ABSPATH') || exit;
get_header();

if ( function_exists('woocommerce_breadcrumb') ) {
    echo '<div class="woo-breadcrumb-wrap"><div class="container">';
    woocommerce_breadcrumb();
    echo '</div></div>';
}
?>

<div class="woo-layout">
    <div class="container">
        <div class="woo-inner woo-inner--single">
            <div class="woo-content">
                <?php woocommerce_content(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
