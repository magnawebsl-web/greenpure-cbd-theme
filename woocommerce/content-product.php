<?php
/**
 * GreenPure CBD — Template carte produit (boucle boutique) v2.0
 * Avec placeholders SVG colorés par catégorie quand aucune image n'existe.
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

/* ── Placeholder par catégorie ── */
$cat_config = [
    'huiles-cbd'    => [
        'bg'    => 'linear-gradient(135deg,#2D6A4F,#52B788)',
        'text'  => '#B7E4C7',
        'icon'  => '<path d="M12 2C8 2 5 5 5 9c0 5 7 13 7 13s7-8 7-13c0-4-3-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5z" fill="currentColor"/><path d="M12 6c-1 0-2 .5-2.5 1.3.5-.2 1-.3 1.5-.3 2 0 3.5 1.5 3.5 3.5S13 14 11 14c.8.3 1.8.5 2.5.2 2-.5 3.5-2.3 3.5-4.2C17 7.7 14.8 6 12 6z" fill="currentColor" opacity=".5"/>',
        'label' => 'Huile CBD',
    ],
    'fleurs-cbd'    => [
        'bg'    => 'linear-gradient(135deg,#6B3FA0,#9B59B6)',
        'text'  => '#E8DAFF',
        'icon'  => '<path d="M12 2c-1 3-3 5-6 5 1 3 3 5 6 5s5-2 6-5c-3 0-5-2-6-5z" fill="currentColor"/><path d="M12 12c-1 3-3 5-6 5 1 3 3 5 6 5s5-2 6-5c-3 0-5-2-6-5z" fill="currentColor" opacity=".6"/>',
        'label' => 'Fleur CBD',
    ],
    'gummies-cbd'   => [
        'bg'    => 'linear-gradient(135deg,#D4700A,#F39C12)',
        'text'  => '#FFF3D4',
        'icon'  => '<circle cx="9" cy="9" r="4" fill="currentColor"/><circle cx="15" cy="9" r="4" fill="currentColor" opacity=".7"/><circle cx="9" cy="15" r="4" fill="currentColor" opacity=".7"/><circle cx="15" cy="15" r="4" fill="currentColor" opacity=".5"/>',
        'label' => 'Gummies CBD',
    ],
    'cosmetiques'   => [
        'bg'    => 'linear-gradient(135deg,#C2185B,#E91E63)',
        'text'  => '#FFD6E7',
        'icon'  => '<path d="M12 2a5 5 0 0 1 5 5c0 2-1 3.5-2.5 4.5V20a2.5 2.5 0 0 1-5 0v-8.5C8 10.5 7 9 7 7a5 5 0 0 1 5-5z" fill="currentColor"/><ellipse cx="12" cy="7" rx="2.5" ry="3.5" fill="currentColor" opacity=".4"/>',
        'label' => 'Cosmétique',
    ],
    'infusions-cbd' => [
        'bg'    => 'linear-gradient(135deg,#2E7D32,#4CAF50)',
        'text'  => '#C8E6C9',
        'icon'  => '<path d="M5 3h14l-1 10H6L5 3z" fill="currentColor" opacity=".4"/><path d="M6 13s0 6 6 6 6-6 6-6H6z" fill="currentColor"/><path d="M9 3c0-1 1-2 3-2s3 1 3 2" fill="none" stroke="currentColor" stroke-width="1.5"/>',
        'label' => 'Infusion',
    ],
    'capsules-cbd'  => [
        'bg'    => 'linear-gradient(135deg,#0277BD,#0288D1)',
        'text'  => '#B3E5FC',
        'icon'  => '<ellipse cx="12" cy="12" rx="5" ry="9" fill="none" stroke="currentColor" stroke-width="1.5"/><line x1="7" y1="12" x2="17" y2="12" stroke="currentColor" stroke-width="1.5"/><ellipse cx="12" cy="8" rx="5" ry="4" fill="currentColor" opacity=".5"/>',
        'label' => 'Capsule CBD',
    ],
    'e-liquides'    => [
        'bg'    => 'linear-gradient(135deg,#37474F,#546E7A)',
        'text'  => '#CFD8DC',
        'icon'  => '<rect x="9" y="2" width="6" height="3" rx="1" fill="currentColor"/><rect x="8" y="5" width="8" height="14" rx="2" fill="currentColor" opacity=".7"/><path d="M10 8c0 2 1 3 2 4s2 2 2 4" fill="none" stroke="currentColor" stroke-width="1.2" opacity=".5"/>',
        'label' => 'E-liquide',
    ],
];

/* Cherche la config de la première catégorie connue */
$placeholder_cfg = null;
foreach ( $cats as $cat_slug ) {
    if ( isset( $cat_config[ $cat_slug ] ) ) {
        $placeholder_cfg = $cat_config[ $cat_slug ];
        break;
    }
}

/* Fallback générique */
if ( ! $placeholder_cfg ) {
    $placeholder_cfg = [
        'bg'    => 'linear-gradient(135deg,#2D6A4F,#52B788)',
        'text'  => '#B7E4C7',
        'icon'  => '<circle cx="12" cy="12" r="8" fill="currentColor" opacity=".4"/><path d="M12 4C8 4 5 7 5 11c0 3 2 5 4 6l3-3 3 3c2-1 4-3 4-6 0-4-3-7-7-7z" fill="currentColor"/>',
        'label' => 'CBD',
    ];
}

/* Déterminer si le produit a une image réelle */
$has_image = $product->get_image_id() > 0;
?>
<li <?php wc_product_class('product-card', $product); ?> data-category="<?php echo esc_attr($cat_str); ?>">

    <div class="product-card__image">
        <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
            <?php if ( $has_image ) : ?>
                <?php echo $product->get_image( 'greenpure-product', [ 'class' => 'product-card__img', 'loading' => 'lazy', 'decoding' => 'async' ] ); ?>
            <?php else : ?>
                <!-- SVG Placeholder coloré selon la catégorie -->
                <div class="product-card__placeholder"
                     style="background:<?php echo esc_attr( $placeholder_cfg['bg'] ); ?>;">
                    <div class="product-card__placeholder-icon"
                         style="background:rgba(255,255,255,0.15); color:<?php echo esc_attr( $placeholder_cfg['text'] ); ?>;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <?php echo $placeholder_cfg['icon']; ?>
                        </svg>
                    </div>
                    <span class="product-card__placeholder-name"
                          style="color:<?php echo esc_attr( $placeholder_cfg['text'] ); ?>;">
                        <?php echo esc_html( get_the_title() ); ?>
                    </span>
                </div>
            <?php endif; ?>
        </a>

        <?php if ( $product->is_on_sale() && $pct > 0 ) : ?>
            <span class="product-badge product-badge--sale">-<?php echo (int) $pct; ?>%</span>
        <?php elseif ( $product->is_featured() ) : ?>
            <span class="product-badge product-badge--featured">Coup de coeur</span>
        <?php elseif (
            ! $product->is_on_backorder() &&
            $product->get_date_created() &&
            ( time() - $product->get_date_created()->getTimestamp() < 30 * DAY_IN_SECONDS )
        ) : ?>
            <span class="product-badge product-badge--new">Nouveau</span>
        <?php endif; ?>

        <div class="product-card__actions">
            <button class="product-card__wishlist js-wishlist"
                    data-id="<?php echo esc_attr( $product->get_id() ); ?>"
                    aria-label="Ajouter aux favoris">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </button>
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>"
               class="product-card__quickview"
               aria-label="Voir le produit">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
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
                <span class="rating-count">(<?php echo (int) $product->get_review_count(); ?>)</span>
            <?php endif; ?>
        </div>

        <?php if ( $product->is_type('variable') ) : ?>
            <p class="product-card__variants">
                <?php
                $attributes = $product->get_variation_attributes();
                $first_attr = reset( $attributes );
                if ( is_array( $first_attr ) ) {
                    /* translators: %d = number of variations */
                    printf( _n( '%d variante disponible', '%d variantes disponibles', count( $first_attr ), 'greenpure-cbd' ), count( $first_attr ) );
                }
                ?>
            </p>
        <?php endif; ?>

        <div class="product-card__footer">
            <div class="product-card__price"><?php echo $product->get_price_html(); ?></div>

            <?php if ( $product->is_purchasable() && $product->is_in_stock() && $product->is_type('simple') ) : ?>
                <?php woocommerce_template_loop_add_to_cart( ['class' => 'btn btn--cart btn--sm'] ); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="btn btn--outline btn--sm">
                    <?php echo $product->is_type('variable') ? esc_html__( 'Choisir', 'greenpure-cbd' ) : esc_html__( 'Voir', 'greenpure-cbd' ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

</li>
