<?php
/**
 * GreenPure CBD — Compteur de résultats
 */
defined('ABSPATH') || exit;

if ( ! woocommerce_products_will_display() ) return;
?>
<p class="woocommerce-result-count">
    <?php
    if ( 1 === $total ) {
        esc_html_e('1 produit', 'greenpure-cbd');
    } elseif ( $total <= $per_page || -1 === $per_page ) {
        /* translators: %d = number of results */
        printf(esc_html__('%d produits', 'greenpure-cbd'), $total);
    } else {
        $first = ($per_page * $current_page) - $per_page + 1;
        $last  = min($total, $per_page * $current_page);
        /* translators: 1: first result 2: last result 3: total results */
        printf(esc_html__('Affichage de %1$d–%2$d sur %3$d produits', 'greenpure-cbd'), $first, $last, $total);
    }
    ?>
</p>
