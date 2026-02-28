<?php
/**
 * GreenPure CBD — Meta fiche produit (SKU, catégories, tags)
 */
defined('ABSPATH') || exit;

global $product;
?>
<div class="product-meta">
    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type('variable') ) ) : ?>
    <span class="product-meta__item sku_wrapper">
        <span class="meta-label"><?php esc_html_e('Réf.', 'greenpure-cbd'); ?></span>
        <span class="sku"><?php echo $product->get_sku() ? esc_html($product->get_sku()) : esc_html__('N/A', 'greenpure-cbd'); ?></span>
    </span>
    <?php endif; ?>

    <?php echo wc_get_product_category_list($product->get_id(), ', ', '<span class="product-meta__item posted_in"><span class="meta-label">' . _n('Catégorie', 'Catégories', count($product->get_category_ids()), 'greenpure-cbd') . '</span> ', '</span>'); ?>

    <?php echo wc_get_product_tag_list($product->get_id(), ', ', '<span class="product-meta__item tagged_as"><span class="meta-label">' . _n('Tag', 'Tags', count($product->get_tag_ids()), 'greenpure-cbd') . '</span> ', '</span>'); ?>

    <?php do_action('woocommerce_product_meta_end'); ?>
</div>
