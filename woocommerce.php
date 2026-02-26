<?php
/**
 * WooCommerce template override — shop / archive
 * Gère l'affichage de la boutique avec sidebar custom
 */
get_header();

// Breadcrumb
if ( function_exists('woocommerce_breadcrumb') ) {
    echo '<div class="woo-breadcrumb-wrap"><div class="container">';
    woocommerce_breadcrumb();
    echo '</div></div>';
}
?>

<div class="woo-layout">
    <div class="container">
        <div class="woo-inner <?php echo is_product() ? 'woo-inner--single' : 'woo-inner--archive'; ?>">

            <?php if ( ! is_product() ): ?>
            <!-- Sidebar boutique -->
            <aside class="woo-sidebar" id="woo-sidebar" aria-label="Filtres boutique">
                <div class="woo-sidebar__inner">
                    <button class="woo-sidebar__close js-sidebar-close" aria-label="Fermer les filtres">✕ Fermer</button>

                    <?php if ( is_active_sidebar('sidebar-shop') ): ?>
                        <?php dynamic_sidebar('sidebar-shop'); ?>
                    <?php else: ?>

                    <!-- Catégories -->
                    <div class="sidebar-widget">
                        <h3 class="widget__title">Catégories</h3>
                        <?php
                        $cat_args = [
                            'taxonomy'   => 'product_cat',
                            'orderby'    => 'name',
                            'show_count' => 1,
                            'pad_counts' => 1,
                            'title_li'   => '',
                            'hide_empty' => 0,
                        ];
                        wp_list_categories( array_merge($cat_args, ['echo' => 1]) );
                        ?>
                    </div>

                    <!-- Filtre prix -->
                    <div class="sidebar-widget">
                        <h3 class="widget__title">Budget</h3>
                        <div class="price-filter">
                            <div class="price-filter__range">
                                <span class="price-filter__min">0 €</span>
                                <input type="range" class="price-range-input js-price-range" min="0" max="200" value="200" step="5">
                                <span class="price-filter__max js-price-max">200 €</span>
                            </div>
                            <a href="#" class="btn btn--outline btn--sm btn--full js-apply-price">Appliquer</a>
                        </div>
                    </div>

                    <!-- Concentrations CBD -->
                    <div class="sidebar-widget">
                        <h3 class="widget__title">Concentration CBD</h3>
                        <ul class="filter-list">
                            <li><label><input type="checkbox" value="5"> 5%</label></li>
                            <li><label><input type="checkbox" value="10"> 10%</label></li>
                            <li><label><input type="checkbox" value="15"> 15%</label></li>
                            <li><label><input type="checkbox" value="20"> 20%</label></li>
                            <li><label><input type="checkbox" value="30"> 30%+</label></li>
                        </ul>
                    </div>

                    <!-- Spectre -->
                    <div class="sidebar-widget">
                        <h3 class="widget__title">Spectre</h3>
                        <ul class="filter-list">
                            <li><label><input type="checkbox" value="full"> Full Spectrum</label></li>
                            <li><label><input type="checkbox" value="broad"> Broad Spectrum</label></li>
                            <li><label><input type="checkbox" value="isolat"> Isolat CBD</label></li>
                        </ul>
                    </div>

                    <!-- Produits populaires -->
                    <div class="sidebar-widget">
                        <h3 class="widget__title">Populaires</h3>
                        <?php
                        $pop = wc_get_products(['limit' => 4, 'orderby' => 'popularity', 'status' => 'publish']);
                        if ( $pop ):
                        ?>
                        <ul class="sidebar-products">
                            <?php foreach ($pop as $p): ?>
                            <li class="sidebar-product">
                                <a href="<?php echo esc_url($p->get_permalink()); ?>" class="sidebar-product__image">
                                    <?php echo $p->get_image('thumbnail', ['loading' => 'lazy']); ?>
                                </a>
                                <div class="sidebar-product__info">
                                    <a href="<?php echo esc_url($p->get_permalink()); ?>"><?php echo esc_html($p->get_name()); ?></a>
                                    <span><?php echo $p->get_price_html(); ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>

                    <?php endif; // sidebar-shop ?>
                </div>
            </aside>
            <?php endif; ?>

            <!-- Contenu principal WooCommerce -->
            <div class="woo-content">
                <?php woocommerce_content(); ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>
