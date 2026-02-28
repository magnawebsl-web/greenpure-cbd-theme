<?php
/**
 * GreenPure CBD — Description courte fiche produit
 */
defined('ABSPATH') || exit;

global $product;
$short_description = apply_filters('woocommerce_short_description', $product->get_short_description());

if ( ! $short_description ) return;
?>
<div class="product-short-description">
    <?php echo $short_description; ?>
</div>
