<?php
/**
 * BORÉA CBD — WooCommerce helpers & overrides
 */
if ( ! defined('ABSPATH') ) exit;
if ( ! class_exists('WooCommerce') ) return;

/* ──────────────────────────────────────
   1. RETIRER ÉLÉMENTS WOOCOMMERCE PAR DÉFAUT
────────────────────────────────────── */
// Retirer la description courte au-dessus du prix sur la fiche produit
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// Remettre la description après le prix
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 25 );

/* ──────────────────────────────────────
   2. FICHE PRODUIT — INFOS CBD CUSTOM
────────────────────────────────────── */
function greenpure_product_cbd_info() {
    global $product;
    $fields = [
        '_cbd_concentration' => ['icon' => '💧', 'label' => 'Concentration CBD'],
        '_cbd_spectrum'      => ['icon' => '🌈', 'label' => 'Spectre'],
        '_cbd_extraction'    => ['icon' => '⚗️', 'label' => 'Extraction'],
        '_cbd_origin'        => ['icon' => '🌍', 'label' => 'Origine'],
        '_cbd_thc'           => ['icon' => '✅', 'label' => 'Taux THC'],
    ];

    $has_data = false;
    foreach ( $fields as $key => $_ ) {
        if ( get_post_meta($product->get_id(), $key, true) ) { $has_data = true; break; }
    }
    if ( ! $has_data ) return;
    ?>
    <div class="product-cbd-info">
        <h3 class="product-cbd-info__title">Informations CBD</h3>
        <div class="cbd-info-grid">
            <?php foreach ( $fields as $key => $f ):
                $val = get_post_meta($product->get_id(), $key, true);
                if ( ! $val ) continue;
            ?>
            <div class="cbd-info-item">
                <span class="cbd-info-icon"><?php echo $f['icon']; ?></span>
                <div>
                    <strong><?php echo esc_html($f['label']); ?></strong>
                    <span><?php echo esc_html($val); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php $report = get_post_meta($product->get_id(), '_cbd_lab_report', true); ?>
        <?php if ( $report ): ?>
        <a href="<?php echo esc_url($report); ?>" class="lab-report-link" target="_blank" rel="noopener">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            Voir le rapport de laboratoire
        </a>
        <?php endif; ?>
    </div>
    <?php
}
add_action( 'woocommerce_single_product_summary', 'greenpure_product_cbd_info', 35 );

/* ──────────────────────────────────────
   3. BADGES DE CONFIANCE SUR FICHE PRODUIT
────────────────────────────────────── */
function greenpure_product_trust_badges() {
    ?>
    <div class="product-trust-badges">
        <div class="ptb-item">
            <svg width="20" height="20" fill="none" stroke="#2D6A4F" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span>Paiement sécurisé SSL</span>
        </div>
        <div class="ptb-item">
            <svg width="20" height="20" fill="none" stroke="#2D6A4F" stroke-width="2" viewBox="0 0 24 24"><path d="M1 3h15v13H1zM16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            <span>Livraison sous 24-48h</span>
        </div>
        <div class="ptb-item">
            <svg width="20" height="20" fill="none" stroke="#2D6A4F" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            <span>Retour 14 jours offerts</span>
        </div>
        <div class="ptb-item">
            <svg width="20" height="20" fill="none" stroke="#2D6A4F" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>Certifié laboratoire ISO</span>
        </div>
    </div>
    <?php
}
add_action( 'woocommerce_single_product_summary', 'greenpure_product_trust_badges', 50 );

/* ──────────────────────────────────────
   4. UPSELL & CROSS-SELL PERSONNALISÉS
────────────────────────────────────── */
// Déplacer les upsells sous les onglets
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_after_single_product_summary', 'greenpure_custom_related', 25 );
function greenpure_custom_related() {
    echo '<div class="product-related-section"><div class="container">';
    woocommerce_output_related_products();
    echo '</div></div>';
}

/* ──────────────────────────────────────
   5. ÉTOILES DE NOTATION — REMAP DISPLAY
────────────────────────────────────── */
add_filter('woocommerce_product_get_rating_html', function($html, $rating, $count) {
    if ( $rating > 0 ) {
        $html = '<div class="star-rating" title="' . esc_attr(sprintf(__('Note : %s sur 5', 'greenpure-cbd'), $rating)) . '">';
        $html .= '<span style="width:' . (($rating / 5) * 100) . '%">';
        $html .= esc_html($rating);
        $html .= '</span></div>';
        if ( $count ) {
            $html .= '<span class="rating-count">(' . esc_html($count) . ')</span>';
        }
    }
    return $html;
}, 10, 3);

/* ──────────────────────────────────────
   6. MINI-PANIER AJAX
────────────────────────────────────── */
function greenpure_mini_cart() {
    check_ajax_referer( 'greenpure_nonce', 'nonce' );
    ob_start();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();
    wp_send_json_success(['cart_html' => $mini_cart, 'count' => WC()->cart->get_cart_contents_count()]);
}
add_action( 'wp_ajax_nopriv_greenpure_mini_cart', 'greenpure_mini_cart' );
add_action( 'wp_ajax_greenpure_mini_cart',         'greenpure_mini_cart' );

/* ──────────────────────────────────────
   7. SCHEMA.ORG PRODUIT
────────────────────────────────────── */
function greenpure_product_schema() {
    if ( ! is_product() ) return;
    global $product;
    if ( ! $product instanceof WC_Product ) {
        $product = wc_get_product( get_queried_object_id() );
    }
    if ( ! $product instanceof WC_Product ) return;
    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Product',
        'name'        => $product->get_name(),
        'description' => wp_strip_all_tags($product->get_short_description()),
        'image'       => wp_get_attachment_image_url($product->get_image_id(), 'full'),
        'brand'       => ['@type' => 'Brand', 'name' => get_bloginfo('name')],
        'offers'      => [
            '@type'         => 'Offer',
            'price'         => $product->get_price(),
            'priceCurrency' => get_woocommerce_currency(),
            'availability'  => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            'url'           => $product->get_permalink(),
        ],
    ];
    if ( $product->get_review_count() > 0 ) {
        $schema['aggregateRating'] = [
            '@type'       => 'AggregateRating',
            'ratingValue' => $product->get_average_rating(),
            'reviewCount' => $product->get_review_count(),
            'bestRating'  => 5,
            'worstRating' => 1,
        ];
    }
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action( 'wp_head', 'greenpure_product_schema' );

/* ──────────────────────────────────────
   8. BREADCRUMB HELPER
────────────────────────────────────── */
if ( ! function_exists('the_breadcrumb') ) {
    function the_breadcrumb() {
        if ( class_exists('WooCommerce') ) {
            woocommerce_breadcrumb();
        }
    }
}
