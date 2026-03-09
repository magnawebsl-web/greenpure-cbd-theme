<?php
/**
 * greenpure-cbd-theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/* ──────────────────────────────────────
   0. CONSTANTS & HELPERS
────────────────────────────────────── */

define( 'GREENPURE_URI', get_template_directory_uri() );
define( 'GREENPURE_VERSION', '1.0.5' );

/**
 * Return a trimmed excerpt of the current post.
 *
 * @param int $length Number of words.
 * @return string
 */
function greenpure_excerpt( int $length = 20 ): string {
    $text = get_the_excerpt();
    if ( ! $text ) {
        $text = get_the_content();
        $text = strip_shortcodes( $text );
        $text = wp_strip_all_tags( $text );
    }
    $words = explode( ' ', $text );
    if ( count( $words ) > $length ) {
        $words = array_slice( $words, 0, $length );
        return implode( ' ', $words ) . '…';
    }
    return $text;
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

    add_image_size( 'greenpure-product', 600, 600, false );
    add_image_size( 'greenpure-showcase', 400, 400, false );

    register_nav_menus( [
        'primary' => 'Menu Principal',
        'footer'  => 'Menu Footer',
    ] );
}
add_action( 'after_setup_theme', 'greenpure_setup' );

function greenpure_scripts() {
    wp_enqueue_style( 'greenpure-style', get_stylesheet_uri(), [], '1.0.5' );
    wp_enqueue_style( 'greenpure-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.0.5' );
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_style( 'greenpure-woo', get_template_directory_uri() . '/assets/css/woocommerce.css', ['greenpure-main'], '1.0.5' );
    }
    wp_enqueue_script( 'greenpure-js', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], '1.0.5', true );
}
add_action( 'wp_enqueue_scripts', 'greenpure_scripts' );

/* ──────────────────────────────────────
   2. WOOCOMMERCE CUSTOMIZATIONS
────────────────────────────────────── */

// Retirer les styles WooCommerce par défaut pour garder le contrôle
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Forcer la devise EUR (€) pour éviter l'affichage $
add_filter( 'woocommerce_currency', function( $currency ) {
    return 'EUR';
} );

add_filter( 'woocommerce_currency_symbol', function( $symbol ) {
    return '€';
} );

/* ──────────────────────────────────────
   FORCE PREMIUM IMAGES DISPLAY (V6 - ULTRA-SIMPLE & SECURE)
   Méthode directe : remplace l'image au moment du rendu HTML
────────────────────────────────────── */

function borea_get_premium_image_url( $product ) {
    if ( ! is_object( $product ) ) {
        return '';
    }
    
    $cat_name = '';
    $cats = $product->get_category_ids();
    if ( ! empty( $cats ) ) {
        $term = get_term( $cats[0], 'product_cat' );
        $cat_name = ( $term && ! is_wp_error( $term ) ) ? $term->name : '';
    }

    $image_name = 'borea_huile_cbd_luxe.png'; // Par défaut
    $product_name = $product->get_name();
    
    if ( stripos($cat_name, 'Fleurs') !== false || stripos($product_name, 'Fleur') !== false ) {
        $image_name = 'borea_fleur_cbd_luxe.png';
    } elseif ( stripos($cat_name, 'Vape') !== false || stripos($cat_name, 'Inhalables') !== false || stripos($product_name, 'Vape') !== false ) {
        $image_name = 'borea_vape_luxe.png';
    } elseif ( stripos($cat_name, 'Gummies') !== false || stripos($cat_name, 'Comestibles') !== false || stripos($product_name, 'Gummies') !== false ) {
        $image_name = 'borea_gummies_luxe.png';
    } elseif ( stripos($cat_name, 'Animaux') !== false || stripos($product_name, 'Animaux') !== false || stripos($product_name, 'Chien') !== false || stripos($product_name, 'Chat') !== false ) {
        $image_name = 'borea_animaux_luxe.png';
    } elseif ( stripos($cat_name, 'Cosmétiques') !== false || stripos($product_name, 'Baume') !== false || stripos($product_name, 'Beurre') !== false || stripos($product_name, 'Crème') !== false ) {
        $image_name = 'borea_cosmetique_luxe.png';
    } elseif ( stripos($cat_name, 'Capsules') !== false || stripos($cat_name, 'Gélules') !== false || stripos($product_name, 'Capsule') !== false || stripos($product_name, 'Gélule') !== false ) {
        $image_name = 'borea_capsule_luxe.png';
    }
    
    return get_template_directory_uri() . '/assets/images/products-premium/' . $image_name;
}

// Filtre pour remplacer l'image produit sur la boutique et les fiches individuelles
add_filter( 'woocommerce_product_get_image', function( $html, $product ) {
    if ( is_admin() || ! class_exists( 'WooCommerce' ) || ! is_object( $product ) ) {
        return $html;
    }
    
    $image_id = $product->get_image_id();
    
    // Si le produit n'a pas d'image, on utilise la premium
    if ( ! $image_id ) {
        $premium_url = borea_get_premium_image_url( $product );
        if ( $premium_url ) {
            return '<img src="' . esc_url( $premium_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="product-image" loading="lazy" decoding="async" />';
        }
    }
    
    return $html;
}, 999, 2 );

// Filtre pour les images dans le panier
add_filter( 'woocommerce_cart_item_thumbnail', function( $thumbnail, $cart_item, $cart_item_key ) {
    if ( is_admin() || ! isset( $cart_item['product_id'] ) ) {
        return $thumbnail;
    }
    
    $product = wc_get_product( $cart_item['product_id'] );
    if ( ! $product ) {
        return $thumbnail;
    }
    
    $image_id = $product->get_image_id();
    if ( ! $image_id ) {
        $premium_url = borea_get_premium_image_url( $product );
        if ( $premium_url ) {
            return '<img src="' . esc_url( $premium_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="product-image" loading="lazy" decoding="async" />';
        }
    }
    
    return $thumbnail;
}, 999, 3 );

/* ──────────────────────────────────────
   SYNC DES SVG PRODUITS (v4)
   Recopie les SVG du thème vers uploads quand la version change.
────────────────────────────────────── */

add_action( 'wp_loaded', function() {
    $sync_key = 'greenpure_svgs_synced_v4';
    if ( get_option( $sync_key ) ) {
        return;
    }

    $svg_files = [
        'huile-cbd-5.svg', 'huile-cbd-10.svg', 'huile-cbd-15.svg',
        'huile-cbd-20.svg', 'huile-cbd-30.svg',
        'huile-sommeil.svg', 'huile-sport.svg',
        'fleur-indoor.svg', 'fleur-outdoor.svg',
        'gummies-fruits.svg', 'gummies-sommeil.svg',
        'creme-cbd.svg', 'baume-cbd.svg', 'serum-cbd.svg',
        'infusion-cbd.svg', 'capsules-cbd.svg',
        'eliquide-cbd.svg', 'hash-cbd.svg',
        'pack-starter.svg', 'pack-sommeil.svg',
    ];

    foreach ( $svg_files as $svg ) {
        $cache_key = 'greenpure_svg_attach_' . sanitize_key( $svg );
        $attach_id = get_option( $cache_key );
        if ( ! $attach_id ) {
            continue;
        }
        $dest = get_attached_file( (int) $attach_id );
        $source = get_template_directory() . '/assets/images/products/' . $svg;
        if ( $dest && $source && file_exists( $source ) && is_writable( dirname( $dest ) ) ) {
            copy( $source, $dest );
        }
    }

    update_option( $sync_key, 1 );
} );

/* ──────────────────────────────────────
   3. LANGUAGE DETECTOR & TRANSLATION
────────────────────────────────────── */

function greenpure_t( $key ) {
    $translations = [
        'skip_to_content' => 'Aller au contenu',
        'free_shipping' => '🚚 Livraison gratuite',
        'shipping_24h' => '24h en France',
        'secure_payment' => '💳 Paiement sécurisé',
        'certified_thc' => '✓ Certifié 0% THC',
        'my_account' => 'Mon compte',
        'login' => 'Connexion',
        'age_title' => 'Confirmation d\'âge',
        'age_text' => 'Nos produits CBD sont réservés aux personnes majeures.',
        'age_question' => 'Avez-vous <strong>18 ans ou plus</strong> ?',
        'age_yes' => 'Oui, j\'ai 18 ans ou plus',
        'age_no' => 'Non, je suis mineur',
        'age_legal' => 'En entrant sur ce site, vous confirmez avoir pris connaissance de nos',
        'age_legal_link' => 'Mentions légales',
    ];
    
    return isset( $translations[ $key ] ) ? $translations[ $key ] : '';
}

function greenpure_lang_switcher_html() {
    return '<span class="lang-switcher">FR</span>';
}

/* ──────────────────────────────────────
   4. CUSTOM HOOKS & FILTERS
────────────────────────────────────── */

// Ajouter des classes au body
add_filter( 'body_class', function( $classes ) {
    if ( is_woocommerce() ) {
        $classes[] = 'woocommerce-page';
    }
    return $classes;
});

// Limiter le nombre de produits par page pour éviter l'épuisement mémoire
add_filter( 'loop_shop_per_page', function() {
    return 12;
}, 20 );

// Fin du fichier
?>
