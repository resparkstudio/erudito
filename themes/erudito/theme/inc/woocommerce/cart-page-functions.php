<?php

/**
 * All functions that are related to the cart page
 */

/**
 * Removing default WooCommerce actions from the template
 */
function erd_remove_woocommerce_cart_actions() {
    remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
    remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
}
add_action('wp_loaded', 'erd_remove_woocommerce_cart_actions');
