<?php
/**
 * GreenPure CBD — Breadcrumb WooCommerce
 */
defined('ABSPATH') || exit;
?>
<nav class="woo-breadcrumb" aria-label="<?php esc_attr_e('Fil d\'Ariane', 'greenpure-cbd'); ?>">
    <div class="container">
        <ol class="breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">
            <?php foreach ( $crumbs as $key => $crumb ) : ?>
            <li class="breadcrumb__item<?php echo $key === array_key_last($crumbs) ? ' breadcrumb__item--current' : ''; ?>"
                itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">

                <?php if ( ! empty($crumb[1]) && $key !== array_key_last($crumbs) ) : ?>
                    <a href="<?php echo esc_url($crumb[1]); ?>" itemprop="item">
                        <span itemprop="name"><?php echo esc_html($crumb[0]); ?></span>
                    </a>
                <?php else : ?>
                    <span itemprop="name"><?php echo esc_html($crumb[0]); ?></span>
                <?php endif; ?>

                <meta itemprop="position" content="<?php echo $key + 1; ?>">

                <?php if ( $key !== array_key_last($crumbs) ) : ?>
                <span class="breadcrumb__sep" aria-hidden="true">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </span>
                <?php endif; ?>

            </li>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
