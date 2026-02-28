<?php
/**
 * GreenPure CBD — Produits similaires
 */
defined('ABSPATH') || exit;

if ( $related_products ) : ?>

<section class="related-products">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Vous aimerez aussi</span>
            <h2 class="section-title">Produits similaires</h2>
        </div>

        <?php woocommerce_product_loop_start(); ?>

            <?php foreach ( $related_products as $related_product ) : ?>

                <?php
                $post_object = get_post( $related_product->get_id() );
                setup_postdata( $GLOBALS['post'] =& $post_object );
                wc_get_template_part( 'content', 'product' );
                ?>

            <?php endforeach; ?>

        <?php woocommerce_product_loop_end(); ?>
    </div>
</section>

<?php
wp_reset_postdata();
endif;
