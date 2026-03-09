<?php
/**
 * greenpure-cbd-theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/* ──────────────────────────────────────
   1. SETUP & ENQUEUE
────────────────────────────────────── */

function greenpure_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    
    register_nav_menus( [
        'primary' => 'Menu Principal',
        'footer'  => 'Menu Footer',
    ] );
}
add_action( 'after_setup_theme', 'greenpure_setup' );

function greenpure_scripts() {
    wp_enqueue_style( 'greenpure-style', get_stylesheet_uri(), [], '1.0.0' );
    wp_enqueue_style( 'greenpure-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.0.0' );
    wp_enqueue_script( 'greenpure-js', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'greenpure_scripts' );

/* ──────────────────────────────────────
   2. WOOCOMMERCE CUSTOMIZATIONS
────────────────────────────────────── */

// Retirer les styles WooCommerce par défaut pour garder le contrôle
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/* ──────────────────────────────────────
   FORCE PREMIUM IMAGES DISPLAY (V3 - SMART)
   Ne remplace l'image QUE si aucune image réelle n'est définie.
────────────────────────────────────── */

add_filter( 'woocommerce_product_get_image', 'borea_force_premium_images_secure', 999, 5 );
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'borea_force_premium_single_image', 999, 2 );
add_filter( 'woocommerce_cart_item_thumbnail', 'borea_force_premium_cart_image', 999, 3 );

function borea_get_premium_image_url( $product ) {
    $cat_name = '';
    $cats = $product->get_category_ids();
    if ( ! empty( $cats ) ) {
        $term = get_term( $cats[0], 'product_cat' );
        $cat_name = ( $term && ! is_wp_error( $term ) ) ? $term->name : '';
    }

    $image_name = 'borea_huile_cbd_luxe.png';
    if ( stripos( $cat_name, 'Inhalables' ) !== false || stripos( $cat_name, 'Vape' ) !== false ) {
        $image_name = 'borea_vape_luxe.png';
    } elseif ( stripos( $cat_name, 'Comestibles' ) !== false || stripos( $cat_name, 'Gummies' ) !== false ) {
        $image_name = 'borea_gummies_luxe.png';
    } elseif ( stripos( $cat_name, 'Animaux' ) !== false ) {
        $image_name = 'borea_animaux_luxe.png';
    } elseif ( stripos( $cat_name, 'Fleurs' ) !== false ) {
        $image_name = 'borea_fleur_cbd_luxe.png';
    } elseif ( stripos( $cat_name, 'Cosmétiques' ) !== false || stripos( $cat_name, 'Baume' ) !== false || stripos( $cat_name, 'Beurre' ) !== false ) {
        $image_name = 'borea_cosmetique_luxe.png';
    } elseif ( stripos( $cat_name, 'Capsules' ) !== false || stripos( $cat_name, 'Gélules' ) !== false ) {
        $image_name = 'borea_capsule_luxe.png';
    }
    
    return get_template_directory_uri() . '/assets/images/products-premium/' . $image_name;
}

function borea_force_premium_images_secure( $html, $product, $size, $attr, $placeholder ) {
    if ( is_admin() || ! class_exists( 'WooCommerce' ) || ! is_object( $product ) ) {
        return $html;
    }

    // SI LE PRODUIT A DÉJÀ UNE IMAGE RÉELLE, ON LA GARDE
    if ( $product->get_image_id() ) {
        $image_src = wp_get_attachment_image_src( $product->get_image_id(), 'full' );
        if ( $image_src && ! empty( $image_src[0] ) && stripos( $image_src[0], 'placeholder' ) === false ) {
            return $html;
        }
    }

    try {
        $image_url = borea_get_premium_image_url( $product );
        return sprintf( 
            '<img src="%s" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail premium-force-img" alt="%s" loading="lazy" style="object-fit: cover; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);" />', 
            esc_url( $image_url ), 
            esc_attr( $product->get_name() ) 
        );
    } catch ( Exception $e ) {
        return $html;
    }
}

function borea_force_premium_single_image( $html, $post_id ) {
    $product = wc_get_product( $post_id );
    if ( ! $product ) return $html;

    if ( $product->get_image_id() ) {
        $image_src = wp_get_attachment_image_src( $product->get_image_id(), 'full' );
        if ( $image_src && ! empty( $image_src[0] ) && stripos( $image_src[0], 'placeholder' ) === false ) {
            return $html;
        }
    }
    
    $image_url = borea_get_premium_image_url( $product );
    return sprintf( 
        '<div class="woocommerce-product-gallery__image"><img src="%s" class="wp-post-image premium-force-img" alt="%s" style="border-radius: 20px; box-shadow: 0 20px 50px rgba(0,0,0,0.1);" /></div>', 
        esc_url( $image_url ), 
        esc_attr( $product->get_name() ) 
    );
}

function borea_force_premium_cart_image( $image, $cart_item, $cart_item_key ) {
    $product = $cart_item['data'];
    if ( $product->get_image_id() ) {
        $image_src = wp_get_attachment_image_src( $product->get_image_id(), 'full' );
        if ( $image_src && ! empty( $image_src[0] ) && stripos( $image_src[0], 'placeholder' ) === false ) {
            return $image;
        }
    }
    $image_url = borea_get_premium_image_url( $product );
    return sprintf( '<img src="%s" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail premium-force-img" alt="%s" style="border-radius: 8px;" />', esc_url( $image_url ), esc_attr( $product->get_name() ) );
}

/* Invalider les transients sidebar/toolbar quand un produit ou une catégorie change */
function borea_flush_shop_transients() {
    delete_transient('borea_sidebar_popular_products');
    delete_transient('borea_toolbar_top_cats');
}
add_action( 'save_post_product',          'borea_flush_shop_transients' );
add_action( 'woocommerce_product_set_stock', 'borea_flush_shop_transients' );
add_action( 'created_product_cat',        'borea_flush_shop_transients' );
add_action( 'edited_product_cat',         'borea_flush_shop_transients' );
add_action( 'deleted_product_cat',        'borea_flush_shop_transients' );

/* ──────────────────────────────────────
   3. WIDGETS / SIDEBARS
────────────────────────────────────── */
function greenpure_widgets_init() {
    register_sidebar( [
        'name'          => 'Sidebar Boutique',
        'id'            => 'sidebar-shop',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget__title">',
        'after_title'   => '</h3>',
    ] );
}
add_action( 'widgets_init', 'greenpure_widgets_init' );

// Inclusion des fichiers de support
require_once get_template_directory() . '/inc/language-detector.php';
