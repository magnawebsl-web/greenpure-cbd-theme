<?php
/**
 * GreenPure CBD — Template carte produit (boucle boutique)
 */
defined('ABSPATH') || exit;

global $product;
if ( ! $product || ! $product->is_visible() ) return;

$cats    = wp_get_post_terms( $product->get_id(), 'product_cat', ['fields' => 'slugs'] );
$cat_str = implode(' ', $cats);
$cbd_con = get_post_meta( $product->get_id(), '_cbd_concentration', true );
$pct     = $product->is_on_sale() && $product->get_regular_price()
           ? round( ( ($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price() ) * 100 )
           : 0;
?>
<li <?php wc_product_class('product-card', $product); ?> data-category="<?php echo esc_attr($cat_str); ?>">

    <div class="product-card__image">
        <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
            <?php echo $product->get_image('greenpure-product', ['class' => 'product-card__img', 'loading' => 'lazy']); ?>
        </a>

        <?php if ( $product->is_on_sale() && $pct > 0 ) : ?>
            <span class="product-badge product-badge--sale">-<?php echo $pct; ?>%</span>
        <?php elseif ( $product->is_featured() ) : ?>
            <span class="product-badge product-badge--featured">Coup de ♥</span>
        <?php elseif ( $product->is_on_backorder() === false && $product->get_date_created() && ( time() - $product->get_date_created()->getTimestamp() < 30 * DAY_IN_SECONDS ) ) : ?>
            <span class="product-badge product-badge--new">Nouveau</span>
        <?php endif; ?>

        <div class="product-card__actions">
            <button class="product-card__wishlist js-wishlist" data-id="<?php echo esc_attr( $product->get_id() ); ?>" aria-label="Ajouter aux favoris">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </button>
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="product-card__quickview" aria-label="Voir le produit">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="product-card__body">
        <?php if ( $cbd_con ) : ?>
            <span class="product-card__tag"><?php echo esc_html( $cbd_con ); ?></span>
        <?php endif; ?>

        <h3 class="product-card__title">
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="product-card__rating">
            <?php echo wc_get_rating_html( $product->get_average_rating(), $product->get_review_count() ); ?>
            <?php if ( $product->get_review_count() ) : ?>
                <span class="rating-count">(<?php echo $product->get_review_count(); ?>)</span>
            <?php endif; ?>
        </div>

        <?php if ( $product->is_type('variable') ) : ?>
            <p class="product-card__variants">
                <?php
                $attributes = $product->get_variation_attributes();
                $first_attr = reset($attributes);
                if ( is_array($first_attr) ) {
                    echo count($first_attr) . ' ' . __('variantes disponibles', 'greenpure-cbd');
                }
                ?>
            </p>
        <?php endif; ?>

        <div class="product-card__footer">
            <div class="product-card__price"><?php echo $product->get_price_html(); ?></div>

            <?php if ( $product->is_purchasable() && $product->is_in_stock() && $product->is_type('simple') ) : ?>
                <?php woocommerce_template_loop_add_to_cart(['class' => 'btn btn--cart btn--sm']); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="btn btn--outline btn--sm">
                    <?php echo $product->is_type('variable') ? 'Choisir' : 'Voir'; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

</li>
