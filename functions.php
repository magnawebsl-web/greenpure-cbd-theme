<?php
/**
 * GreenPure CBD — functions.php
 * Setup du thème, WooCommerce, scripts, styles, widgets, menus
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'GREENPURE_VERSION', '1.0.0' );
define( 'GREENPURE_DIR', get_template_directory() );
define( 'GREENPURE_URI', get_template_directory_uri() );

/* ──────────────────────────────────────
   1. SETUP DU THÈME
────────────────────────────────────── */
function greenpure_setup() {
    load_theme_textdomain( 'greenpure-cbd', GREENPURE_DIR . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form','comment-form','comment-list','gallery','caption','style','script' ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );

    // WooCommerce
    add_theme_support( 'woocommerce', [
        'thumbnail_image_width' => 600,
        'single_image_width'    => 900,
        'product_grid'          => [ 'default_rows' => 3, 'min_rows' => 1, 'default_columns' => 3, 'min_columns' => 1, 'max_columns' => 6 ],
    ]);
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Image sizes
    add_image_size( 'greenpure-hero',    1920, 900, true );
    add_image_size( 'greenpure-product', 600,  600, true );
    add_image_size( 'greenpure-thumb',   300,  300, true );
    add_image_size( 'greenpure-banner',  1200, 500, true );
    add_image_size( 'greenpure-blog',    800,  450, true );

    // Menus
    register_nav_menus([
        'primary'   => __( 'Menu Principal', 'greenpure-cbd' ),
        'secondary' => __( 'Menu Footer',    'greenpure-cbd' ),
        'legal'     => __( 'Menu Légal',     'greenpure-cbd' ),
    ]);
}
add_action( 'after_setup_theme', 'greenpure_setup' );

/* ──────────────────────────────────────
   2. ENQUEUE SCRIPTS & STYLES
────────────────────────────────────── */
function greenpure_scripts() {
    // Google Fonts
    wp_enqueue_style( 'greenpure-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap',
        [], null );

    // Main CSS
    wp_enqueue_style( 'greenpure-main', GREENPURE_URI . '/assets/css/main.css', [], GREENPURE_VERSION );

    // WooCommerce additional
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_style( 'greenpure-woo', GREENPURE_URI . '/assets/css/woocommerce.css', [ 'greenpure-main' ], GREENPURE_VERSION );
    }

    // Main JS
    wp_enqueue_script( 'greenpure-main', GREENPURE_URI . '/assets/js/main.js', [ 'jquery' ], GREENPURE_VERSION, true );

    // Localize
    wp_localize_script( 'greenpure-main', 'greenpureData', [
        'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
        'nonce'     => wp_create_nonce( 'greenpure_nonce' ),
        'cartUrl'   => class_exists('WooCommerce') ? wc_get_cart_url() : '#',
        'currency'  => class_exists('WooCommerce') ? get_woocommerce_currency_symbol() : '€',
    ]);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'greenpure_scripts' );

/* ──────────────────────────────────────
   3. WIDGETS / SIDEBARS
────────────────────────────────────── */
function greenpure_widgets_init() {
    $sidebars = [
        [ 'id' => 'sidebar-shop',   'name' => __( 'Sidebar Boutique', 'greenpure-cbd' ) ],
        [ 'id' => 'sidebar-blog',   'name' => __( 'Sidebar Blog',     'greenpure-cbd' ) ],
        [ 'id' => 'footer-col-1',   'name' => __( 'Footer Colonne 1', 'greenpure-cbd' ) ],
        [ 'id' => 'footer-col-2',   'name' => __( 'Footer Colonne 2', 'greenpure-cbd' ) ],
        [ 'id' => 'footer-col-3',   'name' => __( 'Footer Colonne 3', 'greenpure-cbd' ) ],
        [ 'id' => 'footer-col-4',   'name' => __( 'Footer Colonne 4', 'greenpure-cbd' ) ],
    ];
    foreach ( $sidebars as $s ) {
        register_sidebar([
            'id'            => $s['id'],
            'name'          => $s['name'],
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget__title">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action( 'widgets_init', 'greenpure_widgets_init' );

/* ──────────────────────────────────────
   4. WOOCOMMERCE CUSTOMISATIONS
────────────────────────────────────── */
// Retirer les sidebars WooCommerce par défaut
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Nombre de produits par page
add_filter( 'loop_shop_per_page', fn() => 12 );

// Colonnes boutique
add_filter( 'loop_shop_columns', fn() => 3 );

// Breadcrumb personnalisé
add_filter( 'woocommerce_breadcrumb_defaults', fn($args) => array_merge($args, [
    'delimiter'   => ' <span class="sep">/</span> ',
    'wrap_before' => '<nav class="breadcrumb" aria-label="breadcrumb"><ol>',
    'wrap_after'  => '</ol></nav>',
    'before'      => '<li>',
    'after'       => '</li>',
]) );

// Ajouter badge "Nouveau" aux produits récents
function greenpure_new_badge() {
    global $product;
    $created = get_the_time( 'U', $product->get_id() );
    if ( ( time() - $created ) < ( 30 * DAY_IN_SECONDS ) ) {
        echo '<span class="product-badge product-badge--new">' . __( 'Nouveau', 'greenpure-cbd' ) . '</span>';
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'greenpure_new_badge', 5 );

// Afficher les étoiles sous le titre
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Bouton panier personnalisé
add_filter( 'woocommerce_product_add_to_cart_text', function($text, $product) {
    if ( $product->is_type('simple') && $product->is_in_stock() ) {
        return __( 'Ajouter au panier', 'greenpure-cbd' );
    }
    return $text;
}, 10, 2 );

// Mini cart fragments
add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {
    ob_start();
    ?>
    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['.cart-count'] = ob_get_clean();
    return $fragments;
});

/* ──────────────────────────────────────
   5. CUSTOM POST TYPES
────────────────────────────────────── */
function greenpure_register_post_types() {
    // Témoignages
    register_post_type( 'testimonial', [
        'label'         => __( 'Témoignages', 'greenpure-cbd' ),
        'public'        => false,
        'show_ui'       => true,
        'menu_icon'     => 'dashicons-format-quote',
        'supports'      => [ 'title', 'editor', 'thumbnail' ],
        'show_in_rest'  => true,
    ]);

    // FAQs
    register_post_type( 'faq', [
        'label'         => __( 'FAQs', 'greenpure-cbd' ),
        'public'        => false,
        'show_ui'       => true,
        'menu_icon'     => 'dashicons-editor-help',
        'supports'      => [ 'title', 'editor' ],
        'show_in_rest'  => true,
    ]);
}
add_action( 'init', 'greenpure_register_post_types' );

/* ──────────────────────────────────────
   6. META BOXES PRODUITS CBD
────────────────────────────────────── */
function greenpure_add_product_meta_boxes() {
    add_meta_box( 'greenpure-cbd-info', __( 'Infos CBD', 'greenpure-cbd' ),
        'greenpure_cbd_meta_box_html', 'product', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'greenpure_add_product_meta_boxes' );

function greenpure_cbd_meta_box_html( $post ) {
    $fields = [
        '_cbd_concentration'  => __( 'Concentration CBD (ex: 10%)', 'greenpure-cbd' ),
        '_cbd_spectrum'       => __( 'Spectre (full / broad / isolat)', 'greenpure-cbd' ),
        '_cbd_extraction'     => __( 'Méthode d\'extraction (ex: CO2)', 'greenpure-cbd' ),
        '_cbd_origin'         => __( 'Origine (ex: Union Européenne)', 'greenpure-cbd' ),
        '_cbd_thc'            => __( 'Taux THC (ex: < 0.3%)', 'greenpure-cbd' ),
        '_cbd_terpenes'       => __( 'Terpènes (ex: Myrcène, Limonène)', 'greenpure-cbd' ),
        '_cbd_culture'        => __( 'Mode de culture (Indoor / Outdoor / Greenhouse / N/A)', 'greenpure-cbd' ),
        '_cbd_certifications' => __( 'Certifications (ex: Agriculture Bio, Vegan, ISO 17025)', 'greenpure-cbd' ),
        '_cbd_lot'            => __( 'N° de lot (ex: LOT-2025-GP001)', 'greenpure-cbd' ),
        '_cbd_lab_report'     => __( 'URL Certificat d\'analyse (COA)', 'greenpure-cbd' ),
    ];
    wp_nonce_field( 'greenpure_cbd_meta', 'greenpure_cbd_nonce' );
    foreach ( $fields as $key => $label ) {
        $val = get_post_meta( $post->ID, $key, true );
        printf( '<p><label><strong>%s</strong><br><input type="text" name="%s" value="%s" style="width:100%%"></label></p>',
            esc_html($label), esc_attr($key), esc_attr($val) );
    }
}

function greenpure_save_cbd_meta( $post_id ) {
    if ( ! isset($_POST['greenpure_cbd_nonce']) || ! wp_verify_nonce($_POST['greenpure_cbd_nonce'], 'greenpure_cbd_meta') ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    $fields = [ '_cbd_concentration','_cbd_spectrum','_cbd_extraction','_cbd_origin','_cbd_thc','_cbd_terpenes','_cbd_culture','_cbd_certifications','_cbd_lot','_cbd_lab_report' ];
    foreach ( $fields as $key ) {
        if ( isset($_POST[$key]) ) {
            update_post_meta( $post_id, $key, sanitize_text_field($_POST[$key]) );
        }
    }
}
add_action( 'save_post_product', 'greenpure_save_cbd_meta' );

/* ──────────────────────────────────────
   7. AJAX — Newsletter
────────────────────────────────────── */
function greenpure_newsletter_signup() {
    check_ajax_referer( 'greenpure_nonce', 'nonce' );
    $email = sanitize_email( $_POST['email'] ?? '' );
    if ( ! is_email($email) ) {
        wp_send_json_error( [ 'message' => __('Email invalide.', 'greenpure-cbd') ] );
    }
    // Ici vous intégreriez Mailchimp, Brevo, etc.
    // Pour l'exemple on enregistre dans les options
    $list = get_option('greenpure_newsletter_emails', []);
    $list[] = [ 'email' => $email, 'date' => current_time('mysql') ];
    update_option('greenpure_newsletter_emails', $list);
    wp_send_json_success( [ 'message' => __('Merci ! Vous êtes inscrit(e).', 'greenpure-cbd') ] );
}
add_action( 'wp_ajax_nopriv_greenpure_newsletter', 'greenpure_newsletter_signup' );
add_action( 'wp_ajax_greenpure_newsletter',        'greenpure_newsletter_signup' );

/* ──────────────────────────────────────
   8. HELPERS
────────────────────────────────────── */
function greenpure_excerpt( $length = 20 ) {
    $text = get_the_excerpt();
    return wp_trim_words( $text, $length, '…' );
}

function greenpure_get_rating_stars( $rating ) {
    $output = '<span class="stars">';
    for ($i = 1; $i <= 5; $i++) {
        $class = $i <= $rating ? 'star star--filled' : 'star star--empty';
        $output .= '<span class="' . $class . '">★</span>';
    }
    return $output . '</span>';
}

function greenpure_format_price( $price ) {
    return number_format( (float)$price, 2, ',', ' ' ) . ' €';
}

/* ──────────────────────────────────────
   9. INCLUDES
────────────────────────────────────── */
require_once GREENPURE_DIR . '/inc/customizer.php';
require_once GREENPURE_DIR . '/inc/woocommerce.php';
require_once GREENPURE_DIR . '/inc/demo-data.php';
require_once GREENPURE_DIR . '/inc/language-detector.php';

/* ──────────────────────────────────────
   10. AUTO-SETUP COMPLET (une seule fois)
────────────────────────────────────── */
function greenpure_auto_setup() {
    if ( get_option( 'greenpure_v2_setup_done' ) ) return;
    if ( ! class_exists( 'WooCommerce' ) ) return;

    /* -- Pages WooCommerce -- */
    $wc_pages = [
        'shop'      => [ 'title' => 'Boutique',   'slug' => 'boutique' ],
        'cart'      => [ 'title' => 'Panier',      'slug' => 'panier' ],
        'checkout'  => [ 'title' => 'Commande',    'slug' => 'commande' ],
        'myaccount' => [ 'title' => 'Mon compte',  'slug' => 'mon-compte' ],
    ];

    foreach ( $wc_pages as $key => $data ) {
        $existing = get_option( 'woocommerce_' . $key . '_page_id' );
        if ( $existing && get_post( $existing ) ) continue;

        $page_id = wp_insert_post( [
            'post_title'     => $data['title'],
            'post_name'      => $data['slug'],
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ] );
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_option( 'woocommerce_' . $key . '_page_id', $page_id );
        }
    }

    /* -- Page CGV -- */
    $cgv_exists = get_page_by_path( 'cgv' );
    if ( ! $cgv_exists ) {
        wp_insert_post( [
            'post_title'  => 'Conditions Générales de Vente',
            'post_name'   => 'cgv',
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_content' => '<p>Nos conditions générales de vente sont disponibles sur demande.</p>',
        ] );
    }

    /* -- Page d\'accueil statique -- */
    $front_exists = get_page_by_path( 'accueil' );
    if ( ! $front_exists ) {
        $front_id = wp_insert_post( [
            'post_title'     => 'Accueil',
            'post_name'      => 'accueil',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ] );
    } else {
        $front_id = $front_exists->ID;
    }

    if ( ! empty( $front_id ) && ! is_wp_error( $front_id ) ) {
        update_option( 'page_on_front', $front_id );
        update_option( 'show_on_front', 'page' );
    }

    /* -- Installer les données démo -- */
    if ( function_exists( 'greenpure_install_demo_products' ) ) {
        greenpure_install_demo_products();
    }

    update_option( 'greenpure_v2_setup_done', '1' );
}
add_action( 'admin_init', 'greenpure_auto_setup' );

/* ──────────────────────────────────────
   11. ADMIN NOTICE — Produits manquants
────────────────────────────────────── */
function greenpure_admin_notice_products() {
    if ( ! current_user_can( 'manage_woocommerce' ) ) return;
    if ( ! class_exists( 'WooCommerce' ) ) return;
    if ( get_option( 'greenpure_demo_notice_dismissed' ) ) return;

    $count = wp_count_posts( 'product' );
    $total = ( $count->publish ?? 0 ) + ( $count->draft ?? 0 );

    if ( $total >= 5 ) return;

    $install_url = add_query_arg( 'greenpure_install_demo', '1', admin_url() );
    $dismiss_url = add_query_arg( 'greenpure_dismiss_notice', '1', admin_url() );

    echo '<div class="notice notice-warning is-dismissible greenpure-notice" data-dismiss-url="' . esc_url( $dismiss_url ) . '">';
    echo '<p><strong>GreenPure CBD</strong> — Aucun produit n\'est encore installé.</p>';
    echo '<p><a href="' . esc_url( $install_url ) . '" class="button button-primary">Installer les 70 produits de démo</a>';
    echo ' &nbsp; <a href="' . esc_url( $dismiss_url ) . '" class="button">Ignorer</a></p>';
    echo '</div>';
}
add_action( 'admin_notices', 'greenpure_admin_notice_products' );

function greenpure_handle_notice_dismiss() {
    if ( isset( $_GET['greenpure_dismiss_notice'] ) && current_user_can( 'manage_woocommerce' ) ) {
        update_option( 'greenpure_demo_notice_dismissed', '1' );
        wp_safe_redirect( remove_query_arg( 'greenpure_dismiss_notice' ) );
        exit;
    }
}
add_action( 'admin_init', 'greenpure_handle_notice_dismiss' );

/* ──────────────────────────────────────
   12. SEO — Meta Description & Open Graph
────────────────────────────────────── */
function greenpure_seo_meta() {
    // Ne pas ajouter si Yoast / RankMath / AIOSEO est actif
    if ( function_exists('wpseo_head') || function_exists('rank_math_head') || class_exists('All_in_One_SEO_Pack') ) return;

    $site_name = get_bloginfo('name');
    $site_url  = home_url('/');
    $logo_url  = has_custom_logo() ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : GREENPURE_URI . '/assets/images/og-logo.jpg';

    if ( is_front_page() || is_home() ) {
        $title       = $site_name . ' — CBD Premium Certifié Bio | Livraison Europe';
        $description = 'Boutique CBD n°1 en Europe. Huiles CBD, gummies, fleurs certifiées bio. Extraction CO2, < 0,3% THC. Livraison express 24h. Satisfait ou remboursé 14 jours.';
        $image       = GREENPURE_URI . '/assets/images/og-home.jpg';
        $type        = 'website';
        $url         = $site_url;
    } elseif ( is_product() ) {
        global $product;
        $title       = get_the_title() . ' — ' . $site_name;
        $description = wp_strip_all_tags($product->get_short_description()) ?: get_the_excerpt();
        $description = wp_trim_words($description, 25, '...');
        $image       = wp_get_attachment_image_url($product->get_image_id(), 'greenpure-banner') ?: $logo_url;
        $type        = 'product';
        $url         = get_permalink();
    } elseif ( is_singular() ) {
        $title       = get_the_title() . ' — ' . $site_name;
        $description = wp_trim_words(get_the_excerpt() ?: wp_strip_all_tags(get_the_content()), 25, '...');
        $image       = get_the_post_thumbnail_url(null, 'greenpure-banner') ?: $logo_url;
        $type        = 'article';
        $url         = get_permalink();
    } elseif ( is_tax() || is_category() || is_archive() ) {
        $term        = get_queried_object();
        $title       = $term->name . ' CBD — ' . $site_name;
        $description = $term->description ? wp_trim_words($term->description, 25, '...') : 'Découvrez notre sélection de ' . $term->name . ' certifiés bio.';
        $image       = $logo_url;
        $type        = 'website';
        $url         = get_term_link($term);
    } else {
        return;
    }

    // Meta description
    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";

    // Canonical
    echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";

    // Open Graph
    echo '<meta property="og:type" content="' . esc_attr($type) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    echo '<meta property="og:locale" content="fr_FR">' . "\n";

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
}
add_action( 'wp_head', 'greenpure_seo_meta', 1 );

/* ──────────────────────────────────────
   13. SCHEMA.ORG — Site Web & Organisation (Homepage)
────────────────────────────────────── */
function greenpure_homepage_schema() {
    if ( ! is_front_page() ) return;
    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'  => 'WebSite',
                '@id'    => home_url('/#website'),
                'url'    => home_url('/'),
                'name'   => get_bloginfo('name'),
                'description' => get_bloginfo('description'),
                'potentialAction' => [
                    '@type'       => 'SearchAction',
                    'target'      => ['@type' => 'EntryPoint', 'urlTemplate' => home_url('/?s={search_term_string}')],
                    'query-input' => 'required name=search_term_string',
                ],
            ],
            [
                '@type'  => 'Organization',
                '@id'    => home_url('/#organization'),
                'name'   => get_bloginfo('name'),
                'url'    => home_url('/'),
                'logo'   => ['@type' => 'ImageObject', 'url' => GREENPURE_URI . '/assets/images/logo.png'],
                'email'  => 'contact@greenpure-cbd.com',
                'sameAs' => [
                    'https://www.instagram.com/greenpurecbd',
                    'https://www.facebook.com/greenpurecbd',
                    'https://www.tiktok.com/@greenpurecbd',
                ],
                'areaServed' => ['FR', 'DE', 'NL', 'BE', 'ES', 'IT', 'GB', 'AT', 'PL'],
                'hasOfferCatalog' => [
                    '@type' => 'OfferCatalog',
                    'name'  => 'Produits CBD Premium',
                ],
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action( 'wp_head', 'greenpure_homepage_schema' );

/* ──────────────────────────────────────
   14. PERFORMANCE — Preload & Resource Hints
────────────────────────────────────── */
function greenpure_resource_hints() {
    // Précharger la police principale
    echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    echo '<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@400;500;600;700&display=swap"></noscript>' . "\n";
    // DNS prefetch
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
}
add_action( 'wp_head', 'greenpure_resource_hints', 2 );

// Désactiver le chargement bloquant de Google Fonts (déjà géré en preload ci-dessus)
function greenpure_dequeue_blocking_fonts( $tag, $handle ) {
    if ( $handle === 'greenpure-fonts' ) {
        // Remplacer rel="stylesheet" par media="print" pour le chargement non-bloquant
        return str_replace( "rel='stylesheet'", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", $tag );
    }
    return $tag;
}
add_filter( 'style_loader_tag', 'greenpure_dequeue_blocking_fonts', 10, 2 );

/* ──────────────────────────────────────
   15. SÉCURITÉ & LÉGAL CBD
────────────────────────────────────── */
// Bannière âge (cookie-based, JS gère l'affichage)
function greenpure_age_gate_scripts() {
    // Géré dans main.js
}
add_action( 'wp_footer', 'greenpure_age_gate_scripts' );

/* ──────────────────────────────────────
   16. HEADERS DE SÉCURITÉ
────────────────────────────────────── */
function greenpure_security_headers() {
    if ( ! headers_sent() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
        header( 'Permissions-Policy: geolocation=(), microphone=(), camera=()' );
    }
}
add_action( 'send_headers', 'greenpure_security_headers' );

/* ──────────────────────────────────────
   17. CACHER LA VERSION WP (sécurité)
────────────────────────────────────── */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

/* ──────────────────────────────────────
   18. FILTRE — Retirer l'emoji WP (performance)
────────────────────────────────────── */
function greenpure_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', function($plugins) { return is_array($plugins) ? array_diff($plugins, ['wpemoji']) : []; } );
    add_filter( 'wp_resource_hints', function($urls, $relation_type) {
        if ( $relation_type === 'dns-prefetch' ) {
            return array_filter($urls, function($u) { return !strstr($u, 'https://s.w.org'); });
        }
        return $urls;
    }, 10, 2 );
}
add_action( 'init', 'greenpure_disable_emojis' );

/* ──────────────────────────────────────
   19. PROGRAMME FIDÉLITÉ — Points simples
────────────────────────────────────── */
function greenpure_add_loyalty_points( $order_id ) {
    $order = wc_get_order($order_id);
    if ( ! $order ) return;
    $user_id = $order->get_user_id();
    if ( ! $user_id ) return;
    $total  = (float) $order->get_total();
    $points = (int) floor($total); // 1 point par € dépensé
    $current = (int) get_user_meta($user_id, 'greenpure_loyalty_points', true);
    update_user_meta($user_id, 'greenpure_loyalty_points', $current + $points);
}
if ( class_exists('WooCommerce') ) {
    add_action( 'woocommerce_order_status_completed', 'greenpure_add_loyalty_points' );
}

/* ──────────────────────────────────────
   20. URGENCY — Stock faible
────────────────────────────────────── */
function greenpure_low_stock_badge() {
    global $product;
    if ( ! $product || ! $product->managing_stock() ) return;
    $stock = $product->get_stock_quantity();
    if ( $stock !== null && $stock > 0 && $stock <= 5 ) {
        echo '<div class="low-stock-alert" role="alert">⚠️ Plus que ' . esc_html($stock) . ' en stock !</div>';
    }
}
if ( class_exists('WooCommerce') ) {
    add_action( 'woocommerce_single_product_summary', 'greenpure_low_stock_badge', 22 );
}
