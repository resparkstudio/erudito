<?php

/**
 * Custom woocommerce fragments
 */

function add_cart_totals_fragment($fragments) {

    ob_start();
    WC()->cart->calculate_totals();
    woocommerce_cart_totals();
    $fragments['.cart_totals'] = ob_get_clean();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'add_cart_totals_fragment');
