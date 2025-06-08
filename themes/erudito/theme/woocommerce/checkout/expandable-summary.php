<div class="relative lg:hidden expandable-summary" data-accordion="accordion-instance" data-accordion-duration="600">
	<div data-accordion="accordion-item">
		<button type="button" data-accordion="trigger" class="flex items-center gap-5 pb-5">
			<div class="open-summary-button bg-lavender p-2 rounded-full">
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8 4V12" stroke="black" stroke-linecap="square" stroke-linejoin="round" />
					<path d="M4 8H12" stroke="black" stroke-linecap="square" stroke-linejoin="round" />
				</svg>

			</div>
			<div class="close-summary-button bg-gray p-2 rounded-full">
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4 8H12" stroke="black" stroke-linecap="square" stroke-linejoin="round" />
				</svg>
			</div>

			<p class="text-title-m-mobile font-argent lg:text-title-s mb-6">
				<?php esc_html_e( 'Order summary', 'woocommerce' ); ?>
			</p>
		</button>
		<div data-accordion="expand-wrap" class="overflow-hidden">
			<?php
			$cart_items = WC()->cart->get_cart();
			foreach ( $cart_items as $cart_item_key => $cart_item ) {
				$product   = $cart_item['data'];
				$image_src = wp_get_attachment_image_src( $product->get_image_id(), 'thumbnail' );
				?>
				<div class="flex items-start bg-white mb-1 last-of-type:mb-4 rounded-lg">
					<div class="py-2 pl-2 flex-shrink-0">
						<img src="<?php echo $image_src[0]; ?>" alt="<?php echo $product->get_name(); ?>"
							class="w-[5rem] h-[5rem] object-cover rounded-sm ">
					</div>
					<div class="py-4 pr-4 pl-5 flex flex-col justify-between w-full min-h-[6rem]">
						<div class="flex justify-between w-full">
							<div class="flex gap-2">
								<div class="text-body-m">
									<?php echo $product->get_name(); ?>
								</div>
								<div class="text-body-m">
									<?php echo $product->get_price_html(); ?>
								</div>
							</div>
							<div class="flex  items-center gap-2">
								<svg width="12" height="12" viewBox="0 0 12 12" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path d="M3.00045 8.99955L9 3" stroke="#8B8D8F" stroke-miterlimit="10"
										stroke-linecap="square" />
									<path d="M8.99955 8.99955L3 3" stroke="#8B8D8F" stroke-miterlimit="10"
										stroke-linecap="square" />
								</svg>

								<span class="text-body-s">
									<?php echo $cart_item['quantity']; ?>
								</span>
							</div>
						</div>
						<div class="text-caption-s text-darkGray">
							<?php
							if ( ! empty( $cart_item['attributes'] ) ) {
								$serialized_attributes = maybe_unserialize( $cart_item['attributes'] );

								foreach ( $serialized_attributes as $key => $value ) {
									$attribute       = wc_get_attribute( $key );
									$attribute_label = wc_attribute_label( $attribute->name );

									$value_array = explode( ',', $value );

									$terms = array();
									foreach ( $value_array as $val ) {
										$term = get_term_by( 'slug', $val, $attribute->slug );
										if ( $term ) {
											$terms[] = $term->name;
										}
									}
									?>
									<?php echo $attribute_label ?>
									(
									<?php echo implode( ', ', $terms ); ?>
									)
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
				<?php
			}
			get_template_part( 'woocommerce/checkout/review-order', null, array( 'show_terms' => false ) );
			?>
		</div>
	</div>
</div>

<?php if ( ! is_ajax() ) : ?>
	<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
	<script src="<?php echo get_template_directory_uri() . '/js/accordion.js' ?>"></script>
<?php endif; ?>