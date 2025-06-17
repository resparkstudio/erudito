<?php

/**
 * All functions that are related to content-product.php WooCommerce template
 */

/**
 * Removing default WooCommerce actions from the template
 */
function erd_remove_woocommerce_content_product_actions() {
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
}

add_action('init', 'erd_remove_woocommerce_content_product_actions', 99);


/**
 * Erudito product thumbnail wrap with "New", "Discount" and "Out of stock" labels
 */
function erd_content_product_thumbnail() {
    global $product;
    $image_size = 'woocommerce_thumbnail';
    $image_id = $product->get_image_id();

    // Get product creation date to determine if it's new
    $product_id = $product->get_id();
    $product_creation_date = get_post_time('U', false, $product_id);
    $days_since_creation = (time() - $product_creation_date) / DAY_IN_SECONDS;

    // Define what counts as "new" (e.g., products added in the last 14 days)
    $is_new = $days_since_creation < 7;

    // Determine if product is on sale and calculate discount percentage
    $is_on_sale = $product->is_on_sale();
    $discount_percentage = 0;

    if ($is_on_sale && $product->get_regular_price()) {
        $regular_price = (float) $product->get_regular_price();
        $sale_price = (float) $product->get_sale_price();

        if ($regular_price > 0) {
            $discount_percentage = round(100 - ($sale_price / $regular_price * 100));
        }
    }

    // Check if product is out of stock
    $stock_status = $product->get_stock_status();
    $is_out_of_stock = $stock_status === 'outofstock' ? true : false;
?>

    <div class="relative w-full aspect-[284/356] overflow-hidden">
        <?php
        // Display the product image
        echo wp_get_attachment_image($image_id, $image_size, false, array(
            'class' => 'w-full h-full object-cover transition-transform duration-300 lg:group-hover:scale-120 lg:group-hover:rotate-5',
        ));

        ?>

        <div class="absolute top-1.5 right-1.5 lg:top-4 lg:right-4 flex gap-1 lg:gap-2">
            <?php echo erd_render_product_labels(); ?>
        </div>

        <?php
        // Display button on desktop
        $button_classes = 'erd_button is-secondary rounded-full absolute left-5 right-5 -bottom-20 lg:group-hover:bottom-5 transition-all duration-300 ease-out';

        if ($product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock()) {
            // Simple product - add to cart directly
            echo sprintf(
                '<button href="%s" data-quantity="1" class="%s add_to_cart_button ajax_add_to_cart cursor-pointer" %s>%s</button>',
                esc_url($product->add_to_cart_url()),
                esc_attr($button_classes),
                wc_implode_html_attributes(array(
                    'data-product_id'  => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label'       => $product->add_to_cart_description(),
                    'rel'              => 'nofollow',
                )),
                esc_html__('Add to cart', 'erudito')
            );
        } else {
            // Variable, grouped, external products - link to product page
            echo sprintf(
                '<button href="%s" class="%s cursor-pointer">%s</button>',
                esc_url($product->get_permalink()),
                esc_attr($button_classes),
                $product->is_type('variable') ? esc_html__('More', 'erudito') : esc_html($product->add_to_cart_text())
            );
        }
        ?>
    </div>

    <?php
}
add_action('woocommerce_before_shop_loop_item_title', 'erd_content_product_thumbnail', 10);


/**
 * Erudito custom product title styles
 */
function erd_custom_product_title_classes() {
    return 'text-title-s-mobile text-black lg:text-title-s mt-4 lg:mt-6 mb-1 lg:mb-2';
}
add_filter('woocommerce_product_loop_title_classes', 'erd_custom_product_title_classes', 10, 2);


/**
 * Custom opening and closing <a> tags with tailwind classes
 */
function erd_custom_product_link_open() {
    echo '<a href="' . get_the_permalink() . '" class="group">';
}
add_action('woocommerce_before_shop_loop_item', 'erd_custom_product_link_open', 10);

function erd_custom_product_link_close() {
    echo '</a>';
}
add_action('woocommerce_after_shop_loop_item', 'erd_custom_product_link_close', 5);


/**
 * Custom add to cart loop button
 */
add_action('woocommerce_after_shop_loop_item', 'erd_custom_loop_add_to_cart', 20);
function erd_custom_loop_add_to_cart() {
    global $product;

    if (!$product) return;

    // Base button classes
    $button_classes = 'erd_button is-secondary rounded-full w-full';

    echo '<div class="mt-4 lg:hidden">';

    if ($product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock()) {
        // Simple product - add to cart directly
        echo sprintf(
            '<a href="%s" data-quantity="1" class="%s add_to_cart_button ajax_add_to_cart" %s>%s</a>',
            esc_url($product->add_to_cart_url()),
            esc_attr($button_classes),
            wc_implode_html_attributes(array(
                'data-product_id'  => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label'       => $product->add_to_cart_description(),
                'rel'              => 'nofollow',
            )),
            esc_html__('Add to cart', 'erudito')
        );
    } else {
        // Variable, grouped, external products - link to product page
        echo sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url($product->get_permalink()),
            esc_attr($button_classes),
            $product->is_type('variable') ? esc_html__('More', 'erudito') : esc_html($product->add_to_cart_text())
        );
    }

    echo '</div>';
}


/**
 * Add custom Tailwind classes to product <li> elements
 */
function erd_custom_product_li_classes($classes, $product) {
    if (wc_get_loop_prop('is_shortcode') !== null || is_shop() || is_product_category() || is_product_tag() || is_tax('product_brand')) {
        $classes[] = 'flex';
        $classes[] = 'flex-col';
        $classes[] = 'justify-between';
    }

    return $classes;
}
add_filter('woocommerce_post_class', 'erd_custom_product_li_classes', 10, 2);


/**
 * Output product pricing with custom text styles wrap
 */
function erd_content_product_price_output() {
    global $product;

    if ($product->get_price_html()) {
    ?>
        <div class="text-body-m"><?php echo $product->get_price_html(); ?></div>
<?php
    }
}
add_action('woocommerce_after_shop_loop_item_title', 'erd_content_product_price_output', 10);
