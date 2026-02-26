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
        '_cbd_concentration' => __( 'Concentration CBD (ex: 10%)', 'greenpure-cbd' ),
        '_cbd_extraction'    => __( 'Méthode d\'extraction (ex: CO2)', 'greenpure-cbd' ),
        '_cbd_origin'        => __( 'Origine (ex: Union Européenne)', 'greenpure-cbd' ),
        '_cbd_lab_report'    => __( 'URL Rapport de laboratoire', 'greenpure-cbd' ),
        '_cbd_thc'           => __( 'Taux THC (ex: < 0.3%)', 'greenpure-cbd' ),
        '_cbd_spectrum'      => __( 'Spectre (full / broad / isolat)', 'greenpure-cbd' ),
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
    $fields = [ '_cbd_concentration','_cbd_extraction','_cbd_origin','_cbd_lab_report','_cbd_thc','_cbd_spectrum' ];
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

/* ──────────────────────────────────────
   10. SÉCURITÉ & LÉGAL CBD
────────────────────────────────────── */
// Bannière âge (cookie-based, JS gère l'affichage)
function greenpure_age_gate_scripts() {
    // Géré dans main.js
}
add_action( 'wp_footer', 'greenpure_age_gate_scripts' );
