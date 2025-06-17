<?php

/**
 * "Order received" message.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-received.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.8.0
 *
 * @var WC_Order|false $order
 */

defined('ABSPATH') || exit;

$order_number_string = '<span class="text-body-m-medium">' . $order->get_order_number() . '</span>';
?>
<div class="flex flex-col gap-y-4 pb-8">

	<h1 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received text-title-l-mobile text-black">
		<?php
		/**
		 * Filter the message shown after a checkout is complete.
		 *
		 * @since 2.2.0
		 *
		 * @param string         $message The message.
		 * @param WC_Order|false $order   The order created during checkout, or false if order data is not available.
		 */
		$message = apply_filters(
			'woocommerce_thankyou_order_received_text',
			esc_html(__('Thank you for your order!', 'woocommerce')),
			$order
		);

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $message;
		?>
	</h1>
	<p class="text-body-m-light">
		<?php esc_html_e('Your order', 'erudito'); ?>
		<span class="text-body-m-medium"><?php esc_html_e('No.', 'erudito'); ?></span>
		<?php printf(__('%s has been confirmed.<br>A confirmation email with your order details will be sent to you shortly.', 'erudito'), $order_number_string); ?>
	</p>
</div>