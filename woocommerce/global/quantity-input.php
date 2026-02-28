<?php
/**
 * GreenPure CBD — Sélecteur de quantité personnalisé
 */
defined('ABSPATH') || exit;

if ( $max_value && $min_value === $max_value ) {
    ?>
    <div class="quantity hidden">
        <input type="hidden" id="<?php echo esc_attr($input_id); ?>"
               class="qty"
               name="<?php echo esc_attr($input_name); ?>"
               value="<?php echo esc_attr($min_value); ?>">
    </div>
    <?php
} else {
    ?>
    <div class="quantity qty-selector">
        <button type="button" class="qty-btn qty-btn--minus" aria-label="<?php esc_attr_e('Diminuer la quantité', 'greenpure-cbd'); ?>">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
        </button>

        <input type="number"
               id="<?php echo esc_attr($input_id); ?>"
               class="input-text qty text"
               name="<?php echo esc_attr($input_name); ?>"
               value="<?php echo esc_attr($input_value); ?>"
               title="<?php echo esc_attr_x('Qté', 'Product quantity input field label', 'greenpure-cbd'); ?>"
               size="4"
               min="<?php echo esc_attr($min_value); ?>"
               max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>"
               step="<?php echo esc_attr($step); ?>"
               placeholder="<?php echo esc_attr($placeholder); ?>"
               inputmode="numeric"
               autocomplete="off"
               <?php echo $readonly ? 'readonly' : ''; ?>
               aria-label="<?php esc_attr_e('Quantité', 'greenpure-cbd'); ?>">

        <button type="button" class="qty-btn qty-btn--plus" aria-label="<?php esc_attr_e('Augmenter la quantité', 'greenpure-cbd'); ?>">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
        </button>
    </div>
    <?php
}
