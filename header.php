<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#2D6A4F">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip link pour l'accessibilité -->
<a href="#main-content" class="skip-link"><?php echo esc_html(greenpure_t('skip_to_content') ?: 'Aller au contenu'); ?></a>

<!-- ══════════════════════════════════
     AGE GATE
══════════════════════════════════ -->
<div class="age-gate" id="age-gate" aria-modal="true" role="dialog" aria-labelledby="age-gate-title" style="display:none;">
    <div class="age-gate__overlay"></div>
    <div class="age-gate__box">
        <div class="age-gate__logo">
            <?php if ( has_custom_logo() ): the_custom_logo(); else: ?>
                <div class="logo-default">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path d="M24 4C13 4 4 13 4 24s9 20 20 20 20-9 20-20S35 4 24 4z" fill="#2D6A4F"/>
                        <path d="M24 12c-1 5-4 9-8 11 2 3 5 5 8 5s6-2 8-5c-4-2-7-6-8-11z" fill="#B7E4C7"/>
                        <path d="M24 12c1 5 4 9 8 11-2 3-5 5-8 5s-6-2-8-5c4-2 7-6 8-11z" fill="#52B788"/>
                    </svg>
                </div>
            <?php endif; ?>
        </div>
        <h2 class="age-gate__title" id="age-gate-title"><?php echo esc_html(greenpure_t('age_gate_title') ?: 'Confirmation d\'âge'); ?></h2>
        <p class="age-gate__text"><?php echo esc_html(greenpure_t('age_gate_text') ?: 'Ce site est réservé aux personnes âgées de 18 ans et plus. Avez-vous l\'âge légal pour accéder à ce contenu ?'); ?></p>
        <div class="age-gate__actions">
            <button class="age-gate__btn age-gate__btn--yes js-age-yes" type="button">
                <?php echo esc_html(greenpure_t('age_gate_yes') ?: 'Oui, j\'ai 18 ans ou plus'); ?>
            </button>
            <button class="age-gate__btn age-gate__btn--no js-age-no" type="button">
                <?php echo esc_html(greenpure_t('age_gate_no') ?: 'Non, j\'ai moins de 18 ans'); ?>
            </button>
        </div>
        <p class="age-gate__legal"><?php echo esc_html(greenpure_t('age_gate_legal') ?: 'En entrant sur ce site, vous acceptez nos conditions d\'utilisation et confirmez avoir l\'âge légal dans votre pays.'); ?></p>
    </div>
</div>

<!-- ══════════════════════════════════
     TOP BAR
══════════════════════════════════ -->
<div class="topbar">
    <div class="container">
        <div class="topbar__inner">
            <div class="topbar__promo">
                <span class="topbar__icon">🌿</span>
                <span><?php echo wp_kses_post(greenpure_t('free_shipping')); ?> — <?php echo wp_kses_post(greenpure_t('shipping_24h')); ?></span>
                <span class="topbar__sep">|</span>
                <span><?php echo wp_kses_post(greenpure_t('secure_payment')); ?></span>
                <span class="topbar__sep">|</span>
                <span><?php echo wp_kses_post(greenpure_t('certified_thc')); ?></span>
            </div>
            <div class="topbar__right">
                <?php if ( is_user_logged_in() ): ?>
                    <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                        <?php echo esc_html(greenpure_t('my_account')); ?>
                    </a>
                <?php else: ?>
                    <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                        <?php echo esc_html(greenpure_t('login')); ?>
                    </a>
                <?php endif; ?>
                <a href="<?php echo esc_url(home_url('/blog')); ?>">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17 8C8 10 5.9 16.17 3.82 19.11L5.71 21l1-2.3A4.49 4.49 0 0 0 8 19c8 0 10-8 10-8s-4 2-6.53 2.65A2.5 2.5 0 0 0 12 14c-2 0-2-2-4-2a4 4 0 0 0-2.49.87L4 11c1-2 3-4 9-4l4 1z"/></svg>
                    Blog CBD
                </a>
                <span class="topbar__sep">|</span>
                <?php echo greenpure_lang_switcher_html(); ?>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════
     HEADER PRINCIPAL
══════════════════════════════════ -->
	<header class="site-header" id="site-header" role="banner">
	    <div class="container" style="height: 100%;">
	        <div class="site-header__inner" style="display: flex; align-items: center; justify-content: space-between; height: 100%;">

            <!-- Logo -->
            <a class="site-header__logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>">
                <?php if ( has_custom_logo() ): ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>
                    <div class="logo-default">
                        <svg width="40" height="40" viewBox="0 0 48 48" fill="none">
                            <path d="M24 4C13 4 4 13 4 24s9 20 20 20 20-9 20-20S35 4 24 4z" fill="#2D6A4F"/>
                            <path d="M24 12c-1 5-4 9-8 11 2 3 5 5 8 5s6-2 8-5c-4-2-7-6-8-11z" fill="#B7E4C7"/>
                            <path d="M24 12c1 5 4 9 8 11-2 3-5 5-8 5s-6-2-8-5c4-2 7-6 8-11z" fill="#52B788"/>
                        </svg>
                        <div class="logo-text">
                            <span class="logo-name"><?php bloginfo('name'); ?></span>
                            <span class="logo-tagline">Premium CBD</span>
                        </div>
                    </div>
                <?php endif; ?>
            </a>

            <!-- Navigation -->
            <nav class="site-nav" role="navigation" aria-label="Navigation principale">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'site-nav__list',
                    'fallback_cb'    => 'greenpure_fallback_menu',
                ]);
                ?>
            </nav>

            <!-- Actions header -->
            <div class="site-header__actions">
                <!-- Recherche -->
                <button class="header-btn header-btn--search js-search-toggle" aria-label="Rechercher">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                </button>

                <!-- Wishlist -->
                <?php if ( class_exists('WooCommerce') ): ?>
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="header-btn header-btn--wishlist" aria-label="Mes favoris">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </a>

                <!-- Panier -->
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="header-btn header-btn--cart" aria-label="Panier">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    <span class="cart-label">Panier</span>
                    <span class="cart-count"><?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?></span>
                </a>
                <?php endif; ?>

                <!-- Burger mobile -->
                <button class="burger js-menu-toggle" aria-label="Menu" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
            </div>

        </div><!-- /.site-header__inner -->
    </div><!-- /.container -->

    <!-- Barre de recherche dépliante -->
    <div class="header-search js-search-bar" role="search" aria-hidden="true">
        <div class="container">
            <?php get_search_form(); ?>
        </div>
    </div>
</header>

<!-- Mobile menu overlay -->
<div class="mobile-menu-overlay js-menu-overlay"></div>
<nav class="mobile-menu js-mobile-menu" aria-label="Menu mobile">
    <button class="mobile-menu__close js-menu-close" aria-label="Fermer le menu">✕</button>
    <div class="mobile-menu__logo">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    </div>
    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'mobile-menu__list',
        'fallback_cb'    => 'greenpure_fallback_menu',
    ]);
    ?>
    <?php if ( class_exists('WooCommerce') ): ?>
    <div class="mobile-menu__actions">
        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="btn btn--primary btn--full">
            Voir mon panier
            <span class="cart-count"><?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?></span>
        </a>
    </div>
    <?php endif; ?>
</nav>

<!-- ══════════════════════════════════
     MAIN CONTENT START
══════════════════════════════════ -->
<main id="main-content" class="site-main" role="main">
<?php

function greenpure_fallback_menu() {
    echo '<ul class="site-nav__list">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Accueil</a></li>';
    if ( class_exists('WooCommerce') ) {
        echo '<li><a href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . '">Boutique</a></li>';
    }
    echo '<li><a href="' . esc_url(home_url('/blog')) . '">Blog</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">Contact</a></li>';
    echo '</ul>';
}
