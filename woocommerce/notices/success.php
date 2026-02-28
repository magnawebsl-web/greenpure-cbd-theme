<?php
/**
 * GreenPure CBD — Notice de succès WooCommerce
 */
defined('ABSPATH') || exit;

if ( ! $notices ) return;
?>

<?php foreach ( $notices as $notice ) : ?>
<div class="woo-notice woo-notice--success" role="alert" aria-live="polite">
    <svg class="woo-notice__icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
        <polyline points="22 4 12 14.01 9 11.01"/>
    </svg>
    <span class="woo-notice__text"><?php echo wc_kses_notice($notice['notice']); ?></span>
    <button type="button" class="woo-notice__close" aria-label="<?php esc_attr_e('Fermer', 'greenpure-cbd'); ?>">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
    </button>
</div>
<?php endforeach; ?>
