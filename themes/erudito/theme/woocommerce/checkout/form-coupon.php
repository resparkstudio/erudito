<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>

<div class="woocommerce-form-coupon !flex items-center gap-2 mb-4" method="post">
	<p class="!w-full">
		<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
		<input type="text" name="coupon_code"
			class="coupon-code input-text border border-gray py-1.5 px-3 rounded-sm !bg-white w-full h-[2rem]  !outline-none"
			placeholder="<?php esc_attr_e( 'Discount Code', 'woocommerce' ); ?>" id="coupon_code" value="" />
	</p>

	<button type="submit"
		class="apply-coupon group block text-center text-button-s w-[3.5625rem] px-2.5 h-[2rem] bg-black text-white rounded-sm"
		name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
		<div class="relative overflow-hidden pointer-events-none">
			<div
				class="pointer-events-none group-hover:-translate-y-full duration-500 group-hover:duration-500 transition-[transform_0.5s_cubic-bezier(0.645,_0.045,_0.355,_1)]">
				<?php esc_html_e( 'Apply', 'woocommerce' ); ?>
			</div>
			<div
				class="pointer-events-none absolute top-0 translate-y-full group-hover:translate-y-0 w-full duration-500 group-hover:duration-500 transition-[transform_0.5s_cubic-bezier(0.645,_0.045,_0.355,_1)]">
				<?php esc_html_e( 'Apply', 'woocommerce' ); ?>
			</div>
		</div>
	</button>
</div>