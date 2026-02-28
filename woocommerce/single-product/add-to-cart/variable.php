<?php
/**
 * GreenPure CBD — Bouton Ajouter au panier — Produit Variable
 */
defined('ABSPATH') || exit;

global $product;

$attribute_keys  = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);
?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="variations_form cart"
      action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
      method="post"
      enctype="multipart/form-data"
      data-product_id="<?php echo absint($product->get_id()); ?>"
      data-product_variations="<?php echo $variations_attr; ?>">

    <?php do_action('woocommerce_before_variations_form'); ?>

    <?php if ( empty($available_variations) && false !== $available_variations ) : ?>
        <p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('Ce produit est actuellement indisponible.', 'greenpure-cbd'))); ?></p>
    <?php else : ?>

        <div class="variations">
            <?php foreach ( $attributes as $attribute_name => $options ) : ?>
            <div class="variation-row">
                <label class="variation-label" for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>">
                    <?php echo wc_attribute_label($attribute_name); ?>
                </label>
                <div class="variation-select-wrap">
                    <?php
                    wc_dropdown_variation_attribute_options([
                        'options'   => $options,
                        'attribute' => $attribute_name,
                        'product'   => $product,
                    ]);
                    ?>
                    <span class="variation-select-arrow">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <div class="single_variation_wrap">
            <?php
            /**
             * @hooked woocommerce_single_variation - 10
             * @hooked woocommerce_single_variation_add_to_cart_button - 20
             */
            do_action('woocommerce_single_variation');
            ?>
        </div>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>

    <?php endif; ?>

    <?php do_action('woocommerce_after_variations_form'); ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>
