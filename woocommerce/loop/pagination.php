<?php
defined('ABSPATH') || exit;
if ( ! woocommerce_products_will_display() ) return;
?>
<nav class="woo-pagination">
    <?php woocommerce_pagination(); ?>
</nav>
