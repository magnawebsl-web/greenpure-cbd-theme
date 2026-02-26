<?php
/**
 * GreenPure CBD — Customizer WordPress
 * Options du thème accessibles dans Apparence > Personnaliser
 */
if ( ! defined('ABSPATH') ) exit;

function greenpure_customizer_register( $wp_customize ) {

    /* ──────────────────────────────────────
       SECTION : Identité & Couleurs
    ────────────────────────────────────── */
    $wp_customize->add_section('greenpure_brand', [
        'title'    => __('GreenPure — Couleurs & Identité', 'greenpure-cbd'),
        'priority' => 30,
    ]);

    $colors = [
        'color_primary'   => ['label' => 'Couleur principale',     'default' => '#2D6A4F'],
        'color_secondary' => ['label' => 'Couleur secondaire',     'default' => '#52B788'],
        'color_accent'    => ['label' => 'Couleur accent (or)',    'default' => '#D4A843'],
        'color_dark'      => ['label' => 'Couleur fond sombre',    'default' => '#0F1F17'],
        'color_text'      => ['label' => 'Couleur texte principal','default' => '#1B2C22'],
    ];
    foreach ( $colors as $id => $opts ) {
        $wp_customize->add_setting("greenpure_{$id}", [
            'default'           => $opts['default'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "greenpure_{$id}", [
            'label'   => __($opts['label'], 'greenpure-cbd'),
            'section' => 'greenpure_brand',
        ]));
    }

    /* ──────────────────────────────────────
       SECTION : Hero
    ────────────────────────────────────── */
    $wp_customize->add_section('greenpure_hero', [
        'title'    => __('GreenPure — Section Hero', 'greenpure-cbd'),
        'priority' => 31,
    ]);

    $hero_fields = [
        'hero_eyebrow'  => ['label' => 'Texte au-dessus du titre',  'default' => 'Certifié < 0,3% THC • Agriculture Biologique', 'type' => 'text'],
        'hero_title'    => ['label' => 'Titre héros',               'default' => 'Le CBD qui change votre vie', 'type' => 'textarea'],
        'hero_subtitle' => ['label' => 'Sous-titre héros',          'default' => 'Découvrez notre gamme premium de produits CBD 100% naturels.', 'type' => 'textarea'],
        'hero_cta_text' => ['label' => 'Texte bouton principal',    'default' => 'Découvrir nos produits', 'type' => 'text'],
        'hero_promo'    => ['label' => 'Code promo bannière',       'default' => 'BIENVENUE15', 'type' => 'text'],
    ];
    foreach ( $hero_fields as $id => $f ) {
        $wp_customize->add_setting("greenpure_{$id}", [
            'default'           => $f['default'],
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $control_args = ['label' => __($f['label'], 'greenpure-cbd'), 'section' => 'greenpure_hero'];
        if ( $f['type'] === 'textarea' ) {
            $wp_customize->add_control(new WP_Customize_Control($wp_customize, "greenpure_{$id}", array_merge($control_args, ['type' => 'textarea'])));
        } else {
            $wp_customize->add_control("greenpure_{$id}", $control_args);
        }
    }

    /* ──────────────────────────────────────
       SECTION : Informations de contact
    ────────────────────────────────────── */
    $wp_customize->add_section('greenpure_contact', [
        'title'    => __('GreenPure — Contact & Réseaux', 'greenpure-cbd'),
        'priority' => 32,
    ]);

    $contact_fields = [
        'contact_phone'     => ['label' => 'Téléphone',         'default' => '+33 1 23 45 67 89'],
        'contact_email'     => ['label' => 'Email contact',     'default' => 'contact@greenpure-cbd.com'],
        'contact_address'   => ['label' => 'Adresse',           'default' => 'Paris, France'],
        'social_instagram'  => ['label' => 'Instagram URL',     'default' => 'https://instagram.com'],
        'social_facebook'   => ['label' => 'Facebook URL',      'default' => 'https://facebook.com'],
        'social_tiktok'     => ['label' => 'TikTok URL',        'default' => 'https://tiktok.com'],
    ];
    foreach ( $contact_fields as $id => $f ) {
        $wp_customize->add_setting("greenpure_{$id}", [
            'default'           => $f['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("greenpure_{$id}", [
            'label'   => __($f['label'], 'greenpure-cbd'),
            'section' => 'greenpure_contact',
        ]);
    }

    /* ──────────────────────────────────────
       SECTION : Bannière & Promotions
    ────────────────────────────────────── */
    $wp_customize->add_section('greenpure_promos', [
        'title'    => __('GreenPure — Promotions', 'greenpure-cbd'),
        'priority' => 33,
    ]);

    $wp_customize->add_setting('greenpure_topbar_text', [
        'default'           => 'Livraison gratuite dès 49€ — Expédition sous 24h',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('greenpure_topbar_text', [
        'label'   => __('Texte barre du haut', 'greenpure-cbd'),
        'section' => 'greenpure_promos',
    ]);

    $wp_customize->add_setting('greenpure_promo_code', [
        'default'           => 'BIENVENUE15',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('greenpure_promo_code', [
        'label'   => __('Code promo section bannière', 'greenpure-cbd'),
        'section' => 'greenpure_promos',
    ]);

    $wp_customize->add_setting('greenpure_promo_discount', [
        'default'           => '15',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('greenpure_promo_discount', [
        'label'       => __('% réduction (ex: 15)', 'greenpure-cbd'),
        'section'     => 'greenpure_promos',
        'type'        => 'number',
        'input_attrs' => ['min' => 1, 'max' => 80],
    ]);

    /* ──────────────────────────────────────
       Génération CSS variables dynamiques
    ────────────────────────────────────── */
    $wp_customize->add_setting('greenpure_generated_css', [
        'default'           => '',
        'sanitize_callback' => 'wp_strip_all_tags',
        'transport'         => 'postMessage',
    ]);
}
add_action( 'customize_register', 'greenpure_customizer_register' );

/**
 * Injecter les couleurs personnalisées en CSS inline
 */
function greenpure_customizer_css() {
    $primary   = get_theme_mod('greenpure_color_primary',   '#2D6A4F');
    $secondary = get_theme_mod('greenpure_color_secondary', '#52B788');
    $accent    = get_theme_mod('greenpure_color_accent',    '#D4A843');
    $dark      = get_theme_mod('greenpure_color_dark',      '#0F1F17');
    $text      = get_theme_mod('greenpure_color_text',      '#1B2C22');
    ?>
    <style id="greenpure-customizer-css">
        :root {
            --color-primary:   <?php echo sanitize_hex_color($primary); ?>;
            --color-secondary: <?php echo sanitize_hex_color($secondary); ?>;
            --color-accent:    <?php echo sanitize_hex_color($accent); ?>;
            --color-dark:      <?php echo sanitize_hex_color($dark); ?>;
            --color-text:      <?php echo sanitize_hex_color($text); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'greenpure_customizer_css' );

/**
 * Refresh sélectif pour le customizer
 */
function greenpure_customizer_preview_js() {
    wp_enqueue_script('greenpure-customizer', GREENPURE_URI . '/assets/js/customizer.js', ['customize-preview'], GREENPURE_VERSION, true);
}
add_action( 'customize_preview_init', 'greenpure_customizer_preview_js' );
