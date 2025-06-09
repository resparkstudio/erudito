<?php

/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

// Check if we need to show subtotal (when there are additional line items)
$has_coupons = !empty(WC()->cart->get_coupons());
$has_shipping = WC()->cart->needs_shipping() && (WC()->cart->show_shipping() || 'yes' === get_option('woocommerce_enable_shipping_calc'));
$has_fees = !empty(WC()->cart->get_fees());
$has_taxes = wc_tax_enabled() && !WC()->cart->display_prices_including_tax() && !empty(WC()->cart->get_tax_totals());

$additional_totals = $has_coupons || $has_shipping || $has_fees || $has_taxes;

?>
<div class="mt-4 md:mt-8 cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

    <?php do_action('woocommerce_before_cart_totals'); ?>

    <div class="flex flex-col w-full gap-3 shop_table shop_table_responsive">

        <?php if ($additional_totals) : ?>
            <div class="flex justify-between cart-subtotal">
                <div class="text-left text-body-m-light"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
                <div class="text-right text-body-m-medium" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php wc_cart_totals_subtotal_html(); ?></div>
            </div>
        <?php endif; ?>

        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
            <div class="flex justify-between cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                <div class="text-left text-body-m-light"><?php esc_html_e('Discount code', 'Erudito'); ?></div>
                <div class="text-right text-body-m-medium" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>">
                    <?php echo wc_price(WC()->cart->get_coupon_discount_amount($code, WC()->cart->display_prices_including_tax())); ?>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

            <?php do_action('woocommerce_cart_totals_before_shipping'); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action('woocommerce_cart_totals_after_shipping'); ?>

        <?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

            <div class="flex justify-between shipping">
                <div><?php esc_html_e('Shipping', 'woocommerce'); ?></div>
                <div data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>"><?php woocommerce_shipping_calculator(); ?></div>
            </div>

        <?php endif; ?>

        <?php foreach (WC()->cart->get_fees() as $fee) : ?>
            <div class="flex justify-between fee">
                <div><?php echo esc_html($fee->name); ?></div>
                <div data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?></div>
            </div>
        <?php endforeach; ?>

        <?php
        if (wc_tax_enabled() && ! WC()->cart->display_prices_including_tax()) {
            $taxable_address = WC()->customer->get_taxable_address();
            $estimated_text  = '';

            if (WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()) {
                /* translators: %s location. */
                $estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
            }

            if ('itemized' === get_option('woocommerce_tax_total_display')) {
                foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        ?>
                    <div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                        <div><?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                ?></div>
                        <div data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="flex justify-between tax-total">
                    <div><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                            ?></div>
                    <div data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></div>
                </div>
        <?php
            }
        }
        ?>

        <?php do_action('woocommerce_cart_totals_before_order_total'); ?>

        <div class="flex justify-between order-total <?php echo $additional_totals ? esc_attr("border-t border-gray3 pt-4 mt-1") : ""; ?>">
            <div class="text-body-m-light"><?php esc_html_e('Total', 'woocommerce'); ?></div>
            <div class="font-argent text-title-s-mobile" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
        </div>

        <?php do_action('woocommerce_cart_totals_after_order_total'); ?>

    </div>

    <div class="wc-proceed-to-checkout mt-6 md:mt-8">
        <?php do_action('woocommerce_proceed_to_checkout'); ?>
    </div>

    <?php do_action('woocommerce_after_cart_totals'); ?>

</div>