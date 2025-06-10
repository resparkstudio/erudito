<div class="cart-product-list">
	<?php
	$cart_items = WC()->cart->get_cart();
	foreach ( $cart_items as $cart_item_key => $cart_item ) {
		$product   = $cart_item['data'];
		$image_src = wp_get_attachment_image_src( $product->get_image_id(), 'thumbnail' );
		?>
		<div class="flex items-center gap-6 border-t border-gray3 last:border-b py-4 last:mb-6">
			<div class="flex-shrink-0">
				<img src="<?php echo $image_src[0]; ?>" alt="<?php echo $product->get_name(); ?>"
					class="w-16 h-auto object-cover aspect-[64/80]">
			</div>
			<div class="flex flex-col grow shrink-0 basis-0 justify-between">
				<div class="flex justify-between w-full">
					<div>
						<div class="text-body-m-medium mb-1">
							<?php echo $product->get_name(); ?>
						</div>
						<div class="text-body-s-light">
							<span>
								<?php echo $cart_item['quantity']; ?>
							</span>
							<?php esc_html_e( 'vnt.', domain: 'erudito' ); ?>
						</div>
					</div>

					<div class="text-body-m-medium">
						<?php echo $product->get_price_html(); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	?>
</div>