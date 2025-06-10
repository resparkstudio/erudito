<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<div class="px-5 py-12 md:p-20 md:pb-26">
    <h1 class="mb-8 text-black text-title-l-mobile md:text-title-l md:mb-16"><?php echo esc_html(get_the_title()); ?></h1>
    <div class="flex flex-col md:grid md:grid-cols-12 md:gap-5">
        <form class="woocommerce-cart-form md:col-span-8 md:pr-15" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php do_action('woocommerce_before_cart_table'); ?>

            <div class="border-t shop_table shop_table_responsive cart woocommerce-cart-form__contents border-gray3" cellspacing="0">

                <?php do_action('woocommerce_before_cart_contents'); ?>

                <?php
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                    /**
                     * Filter the product name.
                     *
                     * @since 2.1.0
                     * @param string $product_name Name of the product in the cart.
                     * @param array $cart_item The product in the cart.
                     * @param string $cart_item_key Key for the product in the cart.
                     */
                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                ?>
                        <div class="flex gap-x-5 py-5 md:py-7 md:gap-x-8 border-b border-gray3 woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                            <div class="product-thumbnail w-22 md:w-32">
                                <?php
                                /**
                                 * Filter the product thumbnail displayed in the WooCommerce cart.
                                 *
                                 * This filter allows developers to customize the HTML output of the product
                                 * thumbnail. It passes the product image along with cart item data
                                 * for potential modifications before being displayed in the cart.
                                 *
                                 * @param string $thumbnail     The HTML for the product image.
                                 * @param array  $cart_item     The cart item data.
                                 * @param string $cart_item_key Unique key for the cart item.
                                 *
                                 * @since 2.1.0
                                 */
                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                if (! $product_permalink) {
                                    echo $thumbnail; // PHPCS: XSS ok.
                                } else {
                                    printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                }
                                ?>
                            </div>

                            <div class="flex flex-col justify-between grow">
                                <div class="flex justify-between">

                                    <div class="text-black product-name text-title-s-mobile md:text-title-s font-argent" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                        <?php
                                        $product_title = $_product->get_title();

                                        if (! $product_permalink) {
                                            echo '<span class="product-title">' . esc_html($product_title) . '</span>';
                                        } else {
                                            echo sprintf('<a href="%s" class="transition-colors product-title hover:text-blue-600">%s</a>', esc_url($product_permalink), esc_html($product_title));
                                        }

                                        do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
                                        ?>

                                        <!-- Attributes displayed below the title, in the same container -->
                                        <div class="text-black text-body-s-light font-public product-attributes">
                                            <?php
                                            foreach ($cart_item['variation'] as $attribute_name => $attribute_value) {
                                                // Convert attribute name to readable label
                                                $attribute_label = wc_attribute_label(str_replace('attribute_', '', $attribute_name));
                                            ?>
                                                <div class="attribute-item">
                                                    <span class="attribute-label"><?php echo esc_html($attribute_label); ?>:</span>
                                                    <span class="attribute-value"><?php echo esc_html(ucfirst($attribute_value)); ?></span>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                                        </div>
                                    </div>

                                    <div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                        <?php if ($_product->is_on_sale()) : ?>
                                            <div class="flex flex-col items-end price-wrapper">
                                                <span class="text-black sale-price text-body-m-medium md:text-title-s md:font-argent">
                                                    <?php echo wc_price($_product->get_sale_price()); ?>
                                                </span>
                                                <span class="line-through text-gray4 original-price text-body-m-medium md:text-title-s md:font-argent">
                                                    <?php echo wc_price($_product->get_regular_price()); ?>
                                                </span>
                                            </div>
                                        <?php else : ?>
                                            <span class="text-black regular-price text-body-m-medium md:text-title-s md:font-argent">
                                                <?php echo wc_price($_product->get_price()); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="flex justify-between w-full">
                                    <div class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?> " data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                        <?php
                                        if ($_product->is_sold_individually()) {
                                            $min_quantity = 1;
                                            $max_quantity = 1;
                                        } else {
                                            $min_quantity = 1;
                                            $max_quantity = $_product->get_max_purchase_quantity();
                                        }

                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $max_quantity,
                                                'min_value'    => $min_quantity,
                                                'product_name' => $product_name,
                                            ),
                                            $_product,
                                            false
                                        );

                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                        ?>
                                    </div>
                                    <div class="product-remove">
                                        <button
                                            type="button"
                                            class="flex items-center justify-center w-10 h-10 p-0 text-black rounded-full remove-item erd_button is-secondary bg-gray md:w-12 md:h-12"
                                            aria-label="<?php echo esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))); ?>"
                                            data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>"
                                            data-product-name="<?php echo esc_attr($product_name); ?>">
                                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.79688 7.19995H19.1969" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                                                <path d="M17.5984 7.19995V18.4C17.5984 19.2 16.7984 20 15.9984 20H7.99844C7.19844 20 6.39844 19.2 6.39844 18.4V7.19995" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                                                <path d="M8.79688 7.2V5.6C8.79688 4.8 9.59688 4 10.3969 4H13.5969C14.3969 4 15.1969 4.8 15.1969 5.6V7.2" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

                <?php do_action('woocommerce_cart_contents'); ?>

                <?php do_action('woocommerce_after_cart_contents'); ?>

            </div>
            <?php do_action('woocommerce_after_cart_table'); ?>
        </form>

        <?php do_action('woocommerce_before_cart_collaterals'); ?>

        <div class="px-5 pt-5 pb-6 mt-8 cart-collaterals md:mt-0 md:p-8 bg-gray md:col-span-4 md:self-start">

            <h2 class="text-black text-title-s-mobile md:text-title-s"><?php esc_html_e('Cart totals', 'woocommerce'); ?></h2>

            <?php if (wc_coupons_enabled()) {
                $applied_coupons = WC()->cart->get_applied_coupons();
                $has_coupon = !empty($applied_coupons);
                $coupon_code = $has_coupon ? $applied_coupons[0] : ''; // Get first coupon
            ?>
                <form class="mt-4 md:mt-6" data-coupon-form="form">
                    <div class="flex items-center bg-white border border-white rounded-l-lg rounded-r-4xl coupon">
                        <label for="coupon_code" class="screen-reader-text"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label>
                        <input
                            data-coupon-form="input"
                            type="text"
                            name="coupon_code"
                            class="py-4 pl-4 pr-2 text-black outline-none grow input-text text-body-m-light placeholder-gray4"
                            id="coupon_code"
                            value="<?php echo esc_attr($coupon_code); ?>"
                            placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
                        <button
                            data-coupon-form="apply-btn"
                            type="submit"
                            class="w-12 h-12 p-0 mr-1 button erd_button <?php echo $has_coupon ? 'hidden' : 'flex'; ?>"
                            name="apply_coupon"
                            value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 7C13.907 10.0531 16.7804 11.9966 20 11.9966C16.7804 11.9966 13.907 13.94 12 17" stroke="
#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
                                <path d="M20 12L4 12" stroke="
#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            data-coupon-form="remove-btn"
                            class="px-8 py-3 mr-1 text-button erd_button is-secondary <?php echo $has_coupon ? 'flex' : 'hidden'; ?>">
                            <?php esc_html_e("Remove", "erudito"); ?>
                        </button>
                    </div>
                    <div data-coupon-form="error" class="hidden mt-2 text-red2 text-label-m"></div>
                    <?php do_action('woocommerce_cart_coupon'); ?>
                </form>
            <?php } ?>

            <?php do_action('woocommerce_cart_actions'); ?>

            <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

            <?php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action('woocommerce_cart_collaterals');
            ?>
        </div>
    </div>
</div>


<?php do_action('woocommerce_after_cart'); ?>