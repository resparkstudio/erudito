<?php

/**
 * Custom price format filter
 */
function erd_custom_price_html($price_html, $product) {
    // For products on sale
    if ($product->is_on_sale()) {
        $regular_price = wc_get_price_to_display($product, ['price' => $product->get_regular_price()]);
        $sale_price = wc_get_price_to_display($product, ['price' => $product->get_sale_price()]);

        return '<span class="flex gap-1">' .
            '<span class="text-black font-medium">' . wc_price($sale_price) . '</span> ' .
            '<span class="line-through font-light text-gray4">' . wc_price($regular_price) . '</span>' .
            '</span>';
    }

    // For regular priced products
    return '<span class="text-black">' . $price_html . '</span>';
}
add_filter('woocommerce_get_price_html', 'erd_custom_price_html', 10, 2);
