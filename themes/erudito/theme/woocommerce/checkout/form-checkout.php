<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout w-full flex"
	action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data"
	aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">
	<div class="w-full bg-lightGray lg:bg-white">
		<div class="w-full px-5 lg:px-20 pt-10 bg-lightGray lg:bg-white">
			<div class="mb-8 lg:mb-20">
				<?php
				if ( get_theme_mod( 'site_logo_dark' ) ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="">
						<img src="<?php echo esc_attr( get_theme_mod( 'site_logo_dark' ) ); ?>"
							alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="h-[3.25rem]">
					</a>
				<?php else : ?>
					<a class="site-title"
						href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_url( bloginfo( 'name' ) ); ?></a>
				<?php endif; ?>
			</div>
		</div>

		<div class="w-full px-5 lg:pl-20 lg:pr-16 pb-5 lg:pb-[4.75rem]!bg-white">
			<?php if ( $checkout->get_checkout_fields() ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div id="customer_details">
					<div>
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
					</div>

					<div>
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>
				<div class="erd_shipping">
					<?php wc_cart_totals_shipping_html(); ?>
				</div>
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			<?php endif; ?>

		</div>
		<div class=" w-full px-5 lg:px-8 pt-7 pb-12 bg-gray lg:hidden">
			<?php
			get_template_part( 'woocommerce/checkout/cart-items' );
			get_template_part( 'woocommerce/checkout/review-order' );

			?>


			<?php
			$order_button_text = apply_filters( 'woocommerce_order_button_text', esc_html__( 'Place order', 'woocommerce' ) );
			?>
			<button type="submit" class="erd_button w-full" <?php esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ) ?>
				name="woocommerce_checkout_place_order" id="place_order"
				value="<?php esc_attr( $order_button_text ) ?>">
				<?php echo $order_button_text ?>
			</button>
		</div>
	</div>

	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	<div class="max-w-[30.8125rem] w-full bg-gray p-10 hidden lg:block rounded-l-[10px]">
		<div class="sticky top-8">

			<h3 id="order_review_heading" class="text-title-m-mobile font-argent lg:text-title-s mb-6">
				<?php esc_html_e( 'Order Summary', 'woocommerce' ); ?>
			</h3>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<?php get_template_part( slug: 'woocommerce/checkout/cart-items' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php
				do_action( hook_name: 'woocommerce_checkout_order_review' );

				$order_button_text = apply_filters( 'woocommerce_order_button_text', esc_html__( 'Place order', 'woocommerce' ) );
				?>
				<button type="submit" class="erd_button w-full" <?php esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ) ?>
					name="woocommerce_checkout_place_order" id="place_order"
					value="<?php esc_attr( $order_button_text ) ?>">
					<?php echo $order_button_text ?>
				</button>

			</div>
		</div>

		<?php do_action( hook_name: 'woocommerce_checkout_after_order_review' ); ?>
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>