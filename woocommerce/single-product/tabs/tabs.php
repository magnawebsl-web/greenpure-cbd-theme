<?php
/**
 * GreenPure CBD — Single Product Tabs
 * Onglets : Description, Infos CBD, Analyses labo, Avis
 */
defined('ABSPATH') || exit;

$product_tabs = apply_filters('woocommerce_product_tabs', []);
if ( empty($product_tabs) ) return;
?>

<div class="product-tabs-wrap">
    <div class="container">

        <div class="product-tabs">
            <nav class="product-tabs__nav" role="tablist">
                <?php $active = true; foreach ( $product_tabs as $key => $tab ) : ?>
                <button class="product-tabs__btn<?php echo $active ? ' is-active' : ''; ?>"
                        id="tab-btn-<?php echo esc_attr($key); ?>"
                        role="tab"
                        aria-selected="<?php echo $active ? 'true' : 'false'; ?>"
                        aria-controls="tab-<?php echo esc_attr($key); ?>"
                        data-tab="<?php echo esc_attr($key); ?>">
                    <?php
                    // Icône selon l'onglet
                    $icons = [
                        'description'       => '<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>',
                        'additional_information' => '<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
                        'reviews'           => '<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
                    ];
                    echo $icons[$key] ?? '<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>';
                    echo esc_html(apply_filters('woocommerce_product_' . $key . '_tab_title', $tab['title'], $key));
                    ?>
                </button>
                <?php $active = false; endforeach; ?>
            </nav>

            <div class="product-tabs__content">
                <?php $active = true; foreach ( $product_tabs as $key => $tab ) : ?>
                <div class="product-tabs__panel<?php echo $active ? ' is-active' : ''; ?>"
                     id="tab-<?php echo esc_attr($key); ?>"
                     role="tabpanel"
                     aria-labelledby="tab-btn-<?php echo esc_attr($key); ?>">
                    <?php
                    if ( isset($tab['callback']) ) {
                        call_user_func($tab['callback'], $key, $tab);
                    }
                    ?>
                </div>
                <?php $active = false; endforeach; ?>
            </div>
        </div>

        <!-- Infos CBD supplémentaires -->
        <?php
        global $product;
        $extra_fields = [
            '_cbd_terpenes'       => ['label' => 'Terpènes',         'icon' => '🌿'],
            '_cbd_culture'        => ['label' => 'Mode de culture',   'icon' => '🌱'],
            '_cbd_certifications' => ['label' => 'Certifications',    'icon' => '🏆'],
            '_cbd_lot'            => ['label' => 'N° de lot',         'icon' => '🔖'],
        ];
        $has_extra = false;
        foreach ( $extra_fields as $key => $_ ) {
            if ( get_post_meta($product->get_id(), $key, true) ) { $has_extra = true; break; }
        }
        if ( $has_extra ) :
        ?>
        <div class="product-extra-cbd">
            <h4 class="product-extra-cbd__title">Traçabilité & Certifications</h4>
            <div class="product-extra-cbd__grid">
                <?php foreach ( $extra_fields as $meta_key => $f ) :
                    $val = get_post_meta($product->get_id(), $meta_key, true);
                    if ( ! $val ) continue;
                ?>
                <div class="extra-cbd-item">
                    <span class="extra-cbd-icon"><?php echo $f['icon']; ?></span>
                    <div class="extra-cbd-text">
                        <strong><?php echo esc_html($f['label']); ?></strong>
                        <span><?php echo esc_html($val); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php
            $report = get_post_meta($product->get_id(), '_cbd_lab_report', true);
            if ( $report ) :
            ?>
            <a href="<?php echo esc_url($report); ?>" class="btn btn--outline btn--sm" target="_blank" rel="noopener noreferrer">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                Télécharger le certificat d'analyse (COA)
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>
</div>
