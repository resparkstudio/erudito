<?php
/**
 * Eureka Slider Block
 *
 * @package erudito
 */

$items = get_field( 'items' );

if ( ! $items ) {
	return;
}

?>

<div class="px-5 lg:px-20 py-12 lg:py-26">
	<div class="swiper eureka-slider">

		<div class="swiper-wrapper">
			<?php foreach ( $items as $item ) : ?>
				<div class="swiper-slide">
					<div class="flex w-full justify-between lg:gap-[7.375rem]">
						<div class="max-w-[32.625rem] flex flex-col justify-between">
							<div>
								<?php if ( $item['top_heading'] ) : ?>
									<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
										<?php echo esc_html( $item['top_heading'] ); ?>
									</h2>
								<?php endif; ?>
								<?php if ( $item['top_description'] ) : ?>
									<p class="text-body-m-light mb-12 lg:mb-0">
										<?php echo esc_html( $item['top_description'] ); ?>
									</p>
								<?php endif; ?>
							</div>
							<?php if ( $item['image'] ) : ?>
								<img src="<?php echo esc_url( $item['image']['url'] ); ?>"
									alt="<?php echo esc_attr( $item['image']['alt'] ); ?>"
									class="w-full mb-8 lg:mb-0 lg:hidden" />
							<?php endif; ?>
							<div>
								<div>
									<?php if ( $item['bottom_heading'] ) : ?>
										<h3 class="text-title-m-mobile lg:text-title-m mb-2 lg:mb-4">
											<?php echo esc_html( $item['bottom_heading'] ); ?>
										</h3>
									<?php endif; ?>
									<?php if ( $item['bottom_description'] ) : ?>
										<p class="text-body-m-light">
											<?php echo esc_html( $item['bottom_description'] ); ?>
										</p>
									<?php endif; ?>
								</div>

							</div>
						</div>
						<div class="w-full max-w-[40rem] hidden lg:block">
							<?php if ( $item['image'] ) : ?>
								<img src="<?php echo esc_url( $item['image']['url'] ); ?>"
									alt="<?php echo esc_attr( $item['image']['alt'] ); ?>" class="w-full" />
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="swiper-pagination eureka-slider-pagination !static mt-10 !w-max !left-0 !top-1/2 lg:!absolute">
		</div>
		<div class="items-end gap-2 hidden lg:flex mt-10">
			<button
				class="eureka-slider-prev erd_icon_button before:bg-gray rounded-full p-3 cursor-pointer disabled:before:bg-[#E7ECF1] disabled:[&_svg]:opacity-50">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g>
						<path d="M12 7C10.093 10.0531 7.21964 11.9966 4 11.9966C7.21964 11.9966 10.093 13.94 12 17"
							stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
						<path d="M4 12L20 12" stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
					</g>
				</svg>
			</button>
			<button
				class="eureka-slider-next erd_icon_button before:bg-gray rounded-full p-3 cursor-pointer disabled:before:bg-[#E7ECF1] disabled:[&_svg]:opacity-50">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 7C13.907 10.0531 16.7804 11.9966 20 11.9966C16.7804 11.9966 13.907 13.94 12 17"
						stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
					<path d="M20 12L4 12" stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
				</svg>
			</button>
		</div>

	</div>
</div>