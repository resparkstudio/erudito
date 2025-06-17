<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;
?>

<div class="woocommerce-order py-12 px-5">

    <?php
    if ($order) :

        do_action('woocommerce_before_thankyou', $order->get_id());
    ?>

        <?php if ($order->has_status('failed')) : ?>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                <?php if (is_user_logged_in()) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                <?php endif; ?>
            </p>

        <?php else : ?>

            <?php wc_get_template('checkout/order-received.php', array('order' => $order)); ?>

            <ul class="border-t border-gray3">
                <?php foreach ($order->get_items() as $item_id => $item) :
                    $product = $item->get_product();

                    // Product title
                    $product_title = $item->get_name();

                    //Product image
                    $image_id = $product->get_image_id();
                    $image_url = wp_get_attachment_image_src($image_id, 'thumbnail')[0];

                    $thumbnail = $product->get_image('woocommerce_thumbnail', ['class' => 'w-16']);
                    // Get price
                    $price_html = $product->get_price_html();

                    // Quantity
                    $quantity = sprintf(__('%s qty.', 'erudito'), $item->get_quantity());
                ?>
                    <li class="flex gap-x-6 py-4 items-center border-b border-gray3">
                        <?php echo $thumbnail ?>

                        <div class="flex justify-between items-start w-full">
                            <div class="flex flex-col gap-y-1">
                                <h3 class="text-body-m-medium text-black font-public"><?php echo esc_html($product_title); ?></h3>
                                <span class="text-body-s-light text-gray4"><?php echo esc_html($quantity) ?></span>
                            </div>

                            <?php echo $price_html ?>
                        </div>
                    </li>

                <?php endforeach; ?>
            </ul>

            <div class="flex flex-col gap-4 text-black mt-5">

                <div class="flex flex-col gap-3">
                    <!-- Subtotal -->
                    <div class="flex justify-between">
                        <h3 class="text-body-m-light font-public"><?php esc_html_e('Subtotal', 'erudito') ?></h3>
                        <span class="text-body-m-medium"><?php echo wc_price($order->get_subtotal()); ?></span>
                    </div>

                    <!-- Discounts -->
                    <div class="flex flex-col gap-3">
                        <div class="flex justify-between">
                            <h3 class="text-body-m-light font-public"><?php esc_html_e('Applied discounts', 'erudito') ?></h3>
                            <span class="text-body-m-medium"><?php echo wc_price($order->get_discount_total()); ?></span>
                            <?php echo $order->get_discount_to_display(); ?>
                        </div>
                    </div>
                </div>

                <!-- Total -->
                <div class="flex justify-between pt-4 border-t border-gray3">
                    <h3 class="text-body-m-light font-public"><?php esc_html_e('Total', 'erudito') ?></h3>
                    <span class="text-title-m-mobile font-argent"><?php echo wc_price($order->get_total()) ?></span>
                </div>
            </div>
        <?php endif; ?>

    <?php else : ?>

        <?php wc_get_template('checkout/order-received.php', array('order' => false)); ?>

    <?php endif; ?>

</div>

<?php get_footer(); ?>