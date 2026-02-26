<?php defined('ABSPATH') || exit; ?>
<div class="no-products-found">
    <div class="no-products-found__icon">🌿</div>
    <h3><?php esc_html_e('Aucun produit trouvé', 'greenpure-cbd'); ?></h3>
    <p><?php esc_html_e('Essayez de modifier vos filtres ou consultez toute notre gamme.', 'greenpure-cbd'); ?></p>
    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn--primary">
        Voir tous nos produits
    </a>
</div>
