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
define( 'GREENPURE_VERSION', '1.0.6' );

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
    wp_enqueue_style( 'greenpure-style', get_stylesheet_uri(), [], GREENPURE_VERSION );
    wp_enqueue_style( 'greenpure-main', get_template_directory_uri() . '/assets/css/main.css', [], GREENPURE_VERSION );
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_style( 'greenpure-woo', get_template_directory_uri() . '/assets/css/woocommerce.css', ['greenpure-main'], GREENPURE_VERSION );
    }
    wp_enqueue_script( 'greenpure-js', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], GREENPURE_VERSION, true );
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

    // Récupère le vrai nom : pour les variations, get_name() inclut les attributs
    $product_name = $product->get_name();

    // Pour les variations, on récupère aussi les catégories depuis le parent
    $product_id = $product->get_id();
    if ( $product->is_type( 'variation' ) ) {
        $product_id = $product->get_parent_id();
    }

    $cat_name = '';
    $terms = get_the_terms( $product_id, 'product_cat' );
    if ( $terms && ! is_wp_error( $terms ) ) {
        $cat_name = implode( ' ', wp_list_pluck( $terms, 'name' ) );
    }

    $n = $product_name; // alias court pour les stripos
    $c = $cat_name;

    // ── Packs / Coffrets / Bundles ──────────────────────────────────────────
    if ( stripos($c, 'Pack') !== false || stripos($c, 'Coffret') !== false || stripos($c, 'Bundle') !== false
         || stripos($n, 'Pack') !== false || stripos($n, 'Coffret') !== false || stripos($n, 'Bundle') !== false
         || stripos($n, 'Starter') !== false || stripos($n, 'Découverte') !== false || stripos($n, 'Collection') !== false ) {
        return get_template_directory_uri() . '/assets/images/products-premium/cbd_lifestyle_hero.png';
    }

    // ── Cosmétiques / Soins topiques ────────────────────────────────────────
    if ( stripos($c, 'Cosmétique') !== false || stripos($c, 'Topique') !== false || stripos($c, 'Soin') !== false
         || stripos($n, 'Baume') !== false || stripos($n, 'Beurre') !== false || stripos($n, 'Crème') !== false
         || stripos($n, 'Sérum') !== false || stripos($n, 'Masque') !== false || stripos($n, 'Gommage') !== false
         || stripos($n, 'Capillaire') !== false || stripos($n, 'Lotion') !== false || stripos($n, 'Roll-on') !== false ) {
        return get_template_directory_uri() . '/assets/images/products-premium/borea_cosmetique_luxe.png';
    }

    // ── Animaux ─────────────────────────────────────────────────────────────
    if ( stripos($c, 'Animaux') !== false || stripos($c, 'Pet') !== false
         || stripos($n, 'Animaux') !== false || stripos($n, 'Chien') !== false
         || stripos($n, 'Chat') !== false || stripos($n, 'Pet') !== false ) {
        // Huile pour animaux → image spécifique huile pet
        if ( stripos($n, 'Huile') !== false || stripos($n, 'Oil') !== false || stripos($n, 'Gouttes') !== false ) {
            return get_template_directory_uri() . '/assets/images/products-premium/cbd_pet_oil_realistic.png';
        }
        // Friandises / snacks animaux
        if ( stripos($n, 'Friandise') !== false || stripos($n, 'Snack') !== false || stripos($n, 'Treat') !== false ) {
            return get_template_directory_uri() . '/assets/images/products-premium/borea_cbd_animaux.png';
        }
        return get_template_directory_uri() . '/assets/images/products-premium/borea_animaux_luxe.png';
    }

    // ── Fleurs / Résines / Hash ─────────────────────────────────────────────
    if ( stripos($c, 'Fleur') !== false || stripos($c, 'Hash') !== false || stripos($c, 'Résine') !== false
         || stripos($n, 'Fleur') !== false || stripos($n, 'Résine') !== false || stripos($n, 'Hash') !== false
         || stripos($n, 'Moonrock') !== false || stripos($n, 'Icerock') !== false || stripos($n, 'Pollen') !== false ) {
        // ── Amnesia Haze → image dédiée ──────────────────────────────────────
        if ( stripos($n, 'Amnesia') !== false ) {
            return get_template_directory_uri() . '/assets/images/products-premium/cbd_flower_realistic.png';
        }
        // ── OG Kush / Gorilla / Gold → image gorilla premium ─────────────────
        if ( stripos($n, 'OG Kush') !== false || stripos($n, 'Gorilla') !== false || stripos($n, 'Gold') !== false ) {
            return get_template_directory_uri() . '/assets/images/products-premium/borea_fleur_cbd_gorilla.png';
        }
        // ── Souches nommées (Purple, Haze, Gelato, Kush…) → réaliste ─────────
        if ( preg_match('/\b(Purple|Haze|Kush|Gelato|Mimosa|Cheese|Lemon|Zkittlez|Runtz|Diesel|Mango|Berry|Tropical|White Widow|Critical|Outdoor)\b/i', $n) ) {
            return get_template_directory_uri() . '/assets/images/products-premium/cbd_flower_realistic.png';
        }
        // ── Indoor générique → gorilla ────────────────────────────────────────
        if ( stripos($n, 'Indoor') !== false ) {
            return get_template_directory_uri() . '/assets/images/products-premium/borea_fleur_cbd_gorilla.png';
        }
        return get_template_directory_uri() . '/assets/images/products-premium/borea_fleur_cbd_luxe.png';
    }

    // ── Vapes / Puffs / E-liquides / Cartouches ─────────────────────────────
    if ( stripos($c, 'Vape') !== false || stripos($c, 'Inhalable') !== false || stripos($c, 'E-liquide') !== false
         || stripos($n, 'Vape') !== false || stripos($n, 'Pen') !== false || stripos($n, 'Puff') !== false
         || stripos($n, 'Cartouche') !== false || stripos($n, 'E-liquide') !== false
         || stripos($n, 'Disposable') !== false || stripos($n, 'Jetable') !== false ) {
        if ( stripos($n, 'Gold') !== false || stripos($n, 'Premium') !== false || stripos($n, 'Luxe') !== false ) {
            return get_template_directory_uri() . '/assets/images/products-premium/borea_vape_pen_gold.png';
        }
        if ( stripos($n, 'Puff') !== false || stripos($n, 'Disposable') !== false || stripos($n, 'Jetable') !== false ) {
            return get_template_directory_uri() . '/assets/images/products-premium/cbd_vape_realistic.png';
        }
        return get_template_directory_uri() . '/assets/images/products-premium/borea_vape_luxe.png';
    }

    // ── Gummies / Comestibles ────────────────────────────────────────────────
    if ( stripos($c, 'Gummie') !== false || stripos($c, 'Comestible') !== false || stripos($c, 'Alimentaire') !== false
         || stripos($n, 'Gummies') !== false || stripos($n, 'Gomme') !== false || stripos($n, 'Bonbon') !== false
         || stripos($n, 'Chocolat') !== false || stripos($n, 'Boisson') !== false || stripos($n, 'Confiserie') !== false
         || stripos($n, 'Caramel') !== false || stripos($n, 'Jelly') !== false || stripos($n, 'Marshmallow') !== false ) {
        if ( stripos($n, 'Sommeil') !== false || stripos($n, 'Nuit') !== false || stripos($n, 'Sleep') !== false
             || stripos($n, 'Mélatonine') !== false || stripos($n, 'Détente') !== false ) {
            return get_template_directory_uri() . '/assets/images/products-premium/borea_gummies_sommeil.png';
        }
        // Gummies aux fruits / saveurs
        if ( preg_match('/\b(Fraise|Framboise|Mangue|Citron|Orange|Cerise|Pastèque|Pêche|Ananas|Fruits|Berry|Tropical)\b/i', $n) ) {
            return get_template_directory_uri() . '/assets/images/products-premium/cbd_gummies_realistic.png';
        }
        return get_template_directory_uri() . '/assets/images/products-premium/borea_gummies_luxe.png';
    }

    // ── Capsules / Gélules ───────────────────────────────────────────────────
    if ( stripos($c, 'Capsule') !== false || stripos($c, 'Gélule') !== false
         || stripos($n, 'Capsule') !== false || stripos($n, 'Gélule') !== false || stripos($n, 'Softgel') !== false ) {
        return get_template_directory_uri() . '/assets/images/products-premium/borea_capsule_luxe.png';
    }

    // ── Huiles CBD (catégorie ou nom) ────────────────────────────────────────
    if ( stripos($c, 'Huile') !== false || stripos($c, 'Oil') !== false || stripos($c, 'Teinture') !== false
         || stripos($n, 'Huile') !== false || stripos($n, 'Oil') !== false
         || stripos($n, 'Teinture') !== false || stripos($n, 'Spray') !== false || stripos($n, 'Gouttes') !== false ) {
        // Haute concentration (20 % et +) ou label Premium/Luxe/Gold → image premium
        if ( preg_match('/\b(20|25|30|40|50)\s*%/i', $n)
             || stripos($n, 'Premium') !== false || stripos($n, 'Luxe') !== false || stripos($n, 'Gold') !== false ) {
            return get_template_directory_uri() . '/assets/images/products-premium/borea_huile_cbd_premium.png';
        }
        // Petites concentrations (5 %, 10 %, 15 %) → image réaliste
        if ( preg_match('/\b(5|10|15)\s*%/i', $n) ) {
            return get_template_directory_uri() . '/assets/images/products-premium/cbd_oil_realistic.png';
        }
        return get_template_directory_uri() . '/assets/images/products-premium/borea_huile_cbd_luxe.png';
    }

    // ── Fallback générique (huile CBD) ───────────────────────────────────────
    return get_template_directory_uri() . '/assets/images/products-premium/borea_huile_cbd_luxe.png';
}

// Filtre pour remplacer l'image produit sur la boutique et les fiches individuelles
add_filter( 'woocommerce_product_get_image', function( $html, $product ) {
    if ( is_admin() || ! class_exists( 'WooCommerce' ) || ! is_object( $product ) ) {
        return $html;
    }

    $premium_url = borea_get_premium_image_url( $product );
    if ( $premium_url ) {
        return '<img src="' . esc_url( $premium_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="product-image" loading="lazy" decoding="async" />';
    }

    return $html;
}, 999, 2 );

// Filtre pour les images dans le panier
add_filter( 'woocommerce_cart_item_thumbnail', function( $thumbnail, $cart_item, $cart_item_key ) {
    if ( is_admin() ) {
        return $thumbnail;
    }

    // Utilise l'objet produit/variation directement (plus précis qu'un ID parent)
    $product = isset( $cart_item['data'] ) && is_object( $cart_item['data'] )
        ? $cart_item['data']
        : ( isset( $cart_item['product_id'] ) ? wc_get_product( $cart_item['product_id'] ) : null );

    if ( ! $product ) {
        return $thumbnail;
    }

    $premium_url = borea_get_premium_image_url( $product );
    if ( $premium_url ) {
        return '<img src="' . esc_url( $premium_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="product-image" loading="lazy" decoding="async" />';
    }

    return $thumbnail;
}, 999, 3 );

// Fiche produit individuelle — image principale
add_filter( 'woocommerce_single_product_image_thumbnail_html', function( $html, $attachment_id ) {
    global $product;
    if ( is_admin() || ! $product ) return $html;
    $premium_url = borea_get_premium_image_url( $product );
    if ( $premium_url ) {
        return '<div class="woocommerce-product-gallery__image"><img src="' . esc_url( $premium_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="wp-post-image" loading="lazy" decoding="async" /></div>';
    }
    return $html;
}, 999, 2 );

// Vignettes galerie fiche produit
add_filter( 'woocommerce_single_product_image_html', function( $html, $post_thumbnail_id ) {
    global $product;
    if ( is_admin() || ! $product ) return $html;
    $premium_url = borea_get_premium_image_url( $product );
    if ( $premium_url ) {
        return '<div class="woocommerce-product-gallery__image"><img src="' . esc_url( $premium_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="wp-post-image" loading="lazy" decoding="async" /></div>';
    }
    return $html;
}, 999, 2 );

// Hook post_thumbnail_html — intercepte get_the_post_thumbnail() utilisé par certains templates
add_filter( 'post_thumbnail_html', function( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    if ( is_admin() ) return $html;
    $product = wc_get_product( $post_id );
    if ( ! $product ) return $html;
    $premium_url = borea_get_premium_image_url( $product );
    if ( ! $premium_url ) return $html;
    $alt = esc_attr( $product->get_name() );
    $cls = 'product-card__img wp-post-image';
    return '<img src="' . esc_url( $premium_url ) . '" alt="' . $alt . '" class="' . $cls . '" loading="lazy" decoding="async" />';
}, 999, 5 );

// Intercepte le placeholder WooCommerce (produits sans image)
add_filter( 'woocommerce_placeholder_img_src', function( $src ) {
    return get_template_directory_uri() . '/assets/images/products-premium/borea_huile_cbd_luxe.png';
} );

// Intercepte woocommerce_product_thumbnail_src — hook présent sur certains blocs Gutenberg
add_filter( 'woocommerce_product_get_image', function( $html, $product, $size = 'woocommerce_thumbnail', $attr = [], $placeholder = true, $image = false ) {
    if ( is_admin() || ! is_object( $product ) ) return $html;
    $premium_url = borea_get_premium_image_url( $product );
    if ( ! $premium_url ) return $html;
    $alt = esc_attr( $product->get_name() );
    return '<img src="' . esc_url( $premium_url ) . '" alt="' . $alt . '" class="product-card__img" loading="lazy" decoding="async" />';
}, 1000, 6 );

/* ──────────────────────────────────────
   SYNC DES IMAGES PNG PREMIUM (v5)
   Recopie les PNG du thème vers uploads quand la version change.
────────────────────────────────────── */

add_action( 'wp_loaded', function() {
    $sync_key = 'greenpure_pngs_synced_v5';
    if ( get_option( $sync_key ) ) {
        return;
    }

    $png_files = [
        'borea_huile_cbd_luxe.png', 'borea_huile_cbd_premium.png',
        'borea_fleur_cbd_gorilla.png', 'borea_fleur_cbd_luxe.png',
        'cbd_flower_realistic.png', 'cbd_oil_realistic.png', 'cbd_lifestyle_hero.png',
        'borea_gummies_luxe.png', 'borea_gummies_sommeil.png', 'cbd_gummies_realistic.png',
        'borea_capsule_luxe.png', 'borea_cosmetique_luxe.png',
        'borea_vape_luxe.png', 'borea_vape_pen_gold.png', 'cbd_vape_realistic.png',
        'borea_animaux_luxe.png', 'borea_cbd_animaux.png', 'cbd_pet_oil_realistic.png',
    ];

    foreach ( $png_files as $png ) {
        $cache_key = 'greenpure_png_attach_' . sanitize_key( $png );
        $attach_id = get_option( $cache_key );
        if ( ! $attach_id ) {
            continue;
        }
        $dest   = get_attached_file( (int) $attach_id );
        $source = get_template_directory() . '/assets/images/products-premium/' . $png;
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

/* ──────────────────────────────────────
   5. MONTANT LIBRE — Page paiement privée
   URL : /montant-libre (non indexée, hors menus)
   Flux : saisie montant → checkout direct (panier invisible)
────────────────────────────────────── */

/**
 * Crée automatiquement :
 *   1. Le produit virtuel WooCommerce "Montant libre" (caché du catalogue)
 *   2. La page WordPress avec slug "montant-libre"
 * Exécuté une seule fois via option.
 */
add_action( 'wp_loaded', function () {
    if ( ! class_exists( 'WooCommerce' ) ) return;

    // ── Produit virtuel ──────────────────────────────────────────────────
    $product_id = (int) get_option( 'borea_montant_libre_product_id', 0 );
    if ( ! $product_id || ! wc_get_product( $product_id ) ) {
        $product = new WC_Product_Simple();
        $product->set_name( 'Montant libre' );
        $product->set_slug( 'montant-libre-product' );
        $product->set_status( 'publish' );
        $product->set_catalog_visibility( 'hidden' );  // invisible boutique
        $product->set_virtual( true );
        $product->set_sold_individually( false );
        $product->set_price( 1 );
        $product->set_regular_price( 1 );
        $product->set_sku( 'BOREA-MONTANT-LIBRE' );
        $product_id = $product->save();
        update_option( 'borea_montant_libre_product_id', $product_id );
    }

    // ── Page WP ─────────────────────────────────────────────────────────
    if ( ! get_page_by_path( 'montant-libre' ) ) {
        wp_insert_post( [
            'post_title'   => 'Montant libre',
            'post_name'    => 'montant-libre',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
    }
} );

/**
 * Intercepte le POST du formulaire /montant-libre.
 * Utilise l'action 'wp' (avant template_redirect) pour que notre
 * redirect vers /checkout parte AVANT les hooks WooCommerce qui
 * redirigent vers /cart après un add_to_cart.
 */
add_action( 'wp', function () {
    if ( ! is_page( 'montant-libre' ) ) return;
    if ( ! isset( $_SERVER['REQUEST_METHOD'] ) || $_SERVER['REQUEST_METHOD'] !== 'POST' ) return;
    if ( ! isset( $_POST['borea_action'] ) || $_POST['borea_action'] !== 'montant_libre' ) return;

    // Vérification nonce (sécurité CSRF)
    if ( ! isset( $_POST['_borea_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_borea_nonce'] ) ), 'borea_montant_libre' ) ) {
        wc_add_notice( 'Requête invalide. Veuillez réessayer.', 'error' );
        return;
    }

    if ( ! class_exists( 'WooCommerce' ) ) return;

    $raw_amount = isset( $_POST['borea_amount'] ) ? sanitize_text_field( wp_unslash( $_POST['borea_amount'] ) ) : '';
    $currency   = isset( $_POST['borea_currency_hidden'] ) ? sanitize_text_field( wp_unslash( $_POST['borea_currency_hidden'] ) ) : 'EUR';
    $amount     = (float) str_replace( ',', '.', $raw_amount );

    // Validation montant
    if ( $amount < 1 || $amount > 99999 ) {
        wc_add_notice( 'Veuillez saisir un montant compris entre 1 € et 99 999 €.', 'error' );
        return;
    }

    // Conversion USD → EUR (taux indicatif 0.92)
    if ( $currency === 'USD' ) {
        $amount = round( $amount * 0.92, 2 );
        if ( $amount < 1 ) {
            wc_add_notice( 'Montant converti trop faible. Veuillez saisir un montant supérieur.', 'error' );
            return;
        }
    }

    $product_id = (int) get_option( 'borea_montant_libre_product_id', 0 );
    if ( ! $product_id ) {
        wc_add_notice( 'Configuration incorrecte. Contactez l\'administrateur.', 'error' );
        return;
    }

    // Vide le panier et ajoute le produit en injectant le prix custom
    // directement dans les données du cart item (plus fiable que la session)
    WC()->cart->empty_cart();
    WC()->cart->add_to_cart( $product_id, 1, 0, [], [ 'borea_custom_price' => $amount ] );

    // Redirige DIRECTEMENT vers le checkout — exit immédiat avant tout hook WC
    wp_safe_redirect( wc_get_checkout_url() );
    exit;
}, 1 );

/**
 * Filet de sécurité : si WooCommerce tente malgré tout de rediriger
 * vers le panier après un add_to_cart, on force le checkout.
 */
add_filter( 'woocommerce_add_to_cart_redirect', function ( $url ) {
    if ( WC()->session && (float) WC()->session->get( 'borea_custom_amount', 0 ) > 0 ) {
        return wc_get_checkout_url();
    }
    return $url;
} );

/**
 * Restaure borea_custom_price quand WooCommerce recharge le panier
 * depuis la session (indispensable sur les pages suivantes comme /checkout).
 * Sans ce hook, les données custom sont perdues entre deux requêtes.
 */
add_filter( 'woocommerce_get_cart_item_from_session', function ( $cart_item, $values ) {
    if ( isset( $values['borea_custom_price'] ) ) {
        $cart_item['borea_custom_price'] = $values['borea_custom_price'];
    }
    return $cart_item;
}, 10, 2 );

/**
 * Override le prix avec le montant restauré depuis la session du cart item.
 */
add_action( 'woocommerce_before_calculate_totals', function ( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    foreach ( $cart->get_cart() as $cart_item ) {
        if ( isset( $cart_item['borea_custom_price'] ) && (float) $cart_item['borea_custom_price'] > 0 ) {
            $cart_item['data']->set_price( (float) $cart_item['borea_custom_price'] );
        }
    }
}, 20 );

// Fin du fichier
?>
