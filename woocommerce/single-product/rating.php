<?php
/**
 * GreenPure CBD — Étoiles de notation fiche produit
 */
defined('ABSPATH') || exit;

global $product;

if ( ! wc_review_ratings_enabled() ) return;

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
?>
<div class="product-rating-wrap">
    <?php if ( $rating_count > 0 ) : ?>
        <?php echo wc_get_rating_html($average, $rating_count); ?>
        <?php if ( comments_open() ) : ?>
            <a href="#reviews" class="rating-link">
                <?php printf(
                    _n('%s avis client', '%s avis clients', $review_count, 'greenpure-cbd'),
                    '<span class="rating-count">' . $review_count . '</span>'
                ); ?>
            </a>
        <?php endif; ?>
    <?php else : ?>
        <?php if ( comments_open() ) : ?>
            <a href="#reviews" class="rating-link rating-link--none">
                <?php esc_html_e('Soyez le premier à laisser un avis', 'greenpure-cbd'); ?>
            </a>
        <?php endif; ?>
    <?php endif; ?>
</div>
