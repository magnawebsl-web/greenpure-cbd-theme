<?php
/**
 * GreenPure CBD — Template page fiche produit
 * Override complet de woocommerce/single-product.php
 */
defined('ABSPATH') || exit;

get_header();
?>

<?php if ( function_exists('woocommerce_breadcrumb') ) : ?>
<div class="woo-breadcrumb-wrap">
    <div class="container">
        <?php woocommerce_breadcrumb(); ?>
    </div>
</div>
<?php endif; ?>

<div class="woo-layout">
    <div class="container">
        <div class="woo-inner woo-inner--single">
            <div class="woo-content woo-content--single">

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php wc_get_template_part('content', 'single-product'); ?>
                <?php endwhile; ?>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
