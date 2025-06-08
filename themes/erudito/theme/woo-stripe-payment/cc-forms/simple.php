<div class="wc-stripe-simple-form flex flex-col lg:flex-row w-full justify-between gap-5">
	<div class="w-full">
		<div class="field">
			<label for="stripe-card-number" class="text-caption-m"
				data-tid=""><?php _e( 'Card Number', 'woo-stripe' ) ?></label>
			<span class="text-darkRed">*</span>
			<div id="stripe-card-number" class="input empty font-soehne mt-1"></div>
			<div class="baseline"></div>
		</div>
	</div>
	<div class="flex justify-between gap-5">

		<div class="w-full lg:w-[8rem]">
			<div class="field half-width">
				<label for="stripe-exp" class="text-caption-m"
					data-tid=""><?php _e( 'Expiration date', 'woo-stripe' ) ?></label><span
					class="text-darkRed">*</span>
				<div id="stripe-exp" class="input empty font-soehne mt-1"></div>
				<div class="baseline"></div>
			</div>
		</div>
		<div class="w-full lg:w-[8rem]">
			<div class="field half-width cvc">
				<label for="stripe-cvv" class="text-caption-m"
					data-tid=""><?php _e( 'Security code', 'woo-stripe' ) ?></label>
				<span class="text-darkRed">*</span>
				<div id="stripe-cvv" class="input empty font-soehne mt-1"></div>
				<div class="baseline"></div>
			</div>
		</div>
	</div>
	<?php if ( $gateway->postal_enabled() ) : ?>
		<div class="row">
			<div class="field postalCode" tabindex="-1">
				<input type="text" id="stripe-postal-code" class="input empty"
					value="<?php echo WC()->checkout()->get_value( 'billing_postcode' ) ?>" />
				<label><?php _e( 'ZIP', 'woo-stripe' ) ?></label>
				<div class="baseline"></div>
			</div>
		</div>
	<?php endif; ?>
</div>