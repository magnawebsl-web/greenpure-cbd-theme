<?php
/**
 * GreenPure CBD — Toolbar boutique (tri + compteur)
 */
defined('ABSPATH') || exit;
?>
<div class="woo-toolbar">
    <div class="woo-toolbar__results">
        <?php woocommerce_result_count(); ?>
    </div>

    <div class="woo-toolbar__controls">
        <!-- Filtre catégories rapides -->
        <?php
        $current_cat = get_queried_object();
        $top_cats    = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'parent'     => 0,
            'number'     => 8,
        ]);
        if ( ! is_wp_error($top_cats) && ! empty($top_cats) ) :
        ?>
        <div class="woo-cat-filter">
            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"
               class="cat-filter-btn<?php echo ! is_product_category() ? ' is-active' : ''; ?>">
                Tous
            </a>
            <?php foreach ( $top_cats as $cat ) : ?>
            <a href="<?php echo esc_url(get_term_link($cat)); ?>"
               class="cat-filter-btn<?php echo ( isset($current_cat->term_id) && $current_cat->term_id === $cat->term_id ) ? ' is-active' : ''; ?>">
                <?php echo esc_html($cat->name); ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Tri -->
        <div class="woo-orderby">
            <?php woocommerce_catalog_ordering(); ?>
            <span class="orderby-arrow">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </span>
        </div>
    </div>
</div>
