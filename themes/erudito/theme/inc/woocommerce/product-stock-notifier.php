<?php

/**
 * Create database table for storing notifications
 */
function erd_create_preorder_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'product_preorders';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        product_id bigint(20) NOT NULL,
        variation_id bigint(20) DEFAULT 0,
        date_created datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY unique_preorder (email, product_id, variation_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'erd_create_preorder_table');


/**
 * Send notifications when products are back in stock
 */
function erd_send_preorder_notifications($product_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'product_preorders';

    $product = wc_get_product($product_id);
    if (!$product) return;

    // Determine if this is a variation or parent product
    if ($product->is_type('variation')) {
        // This is a variation - notify only subscribers for this specific variation
        $subscribers = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $table_name WHERE product_id = %d AND variation_id = %d",
            $product->get_parent_id(), // Parent product ID
            $product_id               // This variation ID
        ));
    } else {
        // This is a simple product or parent variable product
        // For simple products: variation_id = 0
        // For variable products: notify when parent comes in stock
        $subscribers = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $table_name WHERE product_id = %d AND variation_id = 0",
            $product_id
        ));
    }

    if (empty($subscribers)) return;

    foreach ($subscribers as $subscriber) {
        // Get the correct product name (variation name if applicable)
        $notification_product = wc_get_product($product->is_type('variation') ? $product_id : $product_id);
        $product_name = $notification_product->get_name();
        $product_url = get_permalink($product->is_type('variation') ? $product->get_parent_id() : $product_id);

        $subject = sprintf(__("Good news! %s is back in stock", 'erudito'), $product_name);
        $message = sprintf(
            __("The product you requested to be notified about is now available: %s", "erudito"),
            $product_url
        );

        wp_mail($subscriber->email, $subject, $message);

        $wpdb->delete(
            $table_name,
            array('id' => $subscriber->id)
        );
    }
}
add_action('woocommerce_product_set_stock_status', function ($product_id, $status) {
    if ($status === 'instock') {
        erd_send_preorder_notifications($product_id);
    }
}, 10, 2);
add_action('woocommerce_variation_set_stock_status', function ($product_id, $status) {
    if ($status === 'instock') {
        erd_send_preorder_notifications($product_id);
    }
}, 10, 2);
