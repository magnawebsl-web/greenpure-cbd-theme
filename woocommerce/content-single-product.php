<?php
/**
 * GreenPure CBD — Contenu fiche produit individuelle
 * Remplace le template WooCommerce par défaut
 */
defined('ABSPATH') || exit;

global $product;
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('product-single', $product); ?>>

    <?php
    /**
     * @hooked woocommerce_before_single_product_summary - 10 (galerie)
     * @hooked woocommerce_show_product_sale_flash - 10
     */
    do_action('woocommerce_before_single_product_summary');
    ?>

    <div class="product-summary">
        <?php
        /**
         * @hooked woocommerce_template_single_title       - 5
         * @hooked woocommerce_template_single_rating      - 10
         * @hooked woocommerce_template_single_price       - 10
         * @hooked woocommerce_template_single_excerpt     - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta        - 40
         * @hooked woocommerce_template_single_sharing     - 50
         * @hooked greenpure_product_cbd_info              - 35 (inc/woocommerce.php)
         * @hooked greenpure_product_trust_badges          - 50 (inc/woocommerce.php)
         */
        do_action('woocommerce_single_product_summary');
        ?>
    </div>

</div>

<?php
/**
 * @hooked woocommerce_output_product_data_tabs - 10 (onglets)
 * @hooked woocommerce_upsell_display           - 15
 * @hooked woocommerce_output_related_products  - 20
 * @hooked greenpure_custom_related             - 25 (inc/woocommerce.php)
 */
do_action('woocommerce_after_single_product_summary');
?>
