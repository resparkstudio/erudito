<?php
/**
 * Testimonials Slider Block
 *
 * @package erudito
 */

$testimonials = get_field( 'testimonials' );
$type         = get_field( 'type' );
if ( ! $testimonials ) {
	return;
}

if ( ! $type ) {
	$type = 'light_quotes';
}
?>

<div class="bg-gray pb-12 pt-30 lg:py-20 px-5 lg:px-20 flex justify-between relative">
	<svg class="absolute left-3 lg:left-20 -top-0 w-[7.5rem] h-auto lg:w-[8.75rem]" width="140" height="95"
		viewBox="0 0 140 95" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path
			d="M107.982 92.7919C106.51 94.264 105.038 95 103.566 95C102.094 95 100.806 94.264 99.7015 92.7919L95.2852 87.2715C100.806 81.7512 105.406 74.9427 109.086 66.8462C112.398 59.1177 114.054 51.5733 114.054 44.2128C114.054 41.6366 113.686 39.7965 112.95 38.6924C109.27 39.4285 106.326 39.7965 104.118 39.7965C96.7573 39.7965 90.5009 37.0363 85.3486 31.516C79.8282 26.3636 77.068 19.9232 77.068 12.1948C77.068 2.99418 79.8282 -4.36628 85.3486 -9.88664C90.8689 -15.407 98.0454 -18.1671 106.878 -18.1671C117.183 -18.1671 125.279 -14.3029 131.167 -6.5744C137.056 1.52211 140 11.2747 140 22.6834C140 35.5643 137.056 48.2611 131.167 60.7738C125.279 73.6546 117.551 84.3273 107.982 92.7919ZM30.914 92.7918C29.4419 94.2639 27.9698 95 26.4977 95C25.0256 95 23.7375 94.2639 22.6334 92.7918L18.2172 87.2715C23.7375 81.7512 28.3378 74.9427 32.018 66.8462C35.3302 59.1177 36.9863 51.5733 36.9863 44.2128C36.9863 41.6366 36.6183 39.7965 35.8823 38.6924C32.202 39.4285 29.2579 39.7965 27.0497 39.7965C19.6893 39.7965 13.4329 37.0363 8.28054 31.516C2.7602 26.3636 6.56342e-06 19.9232 7.23906e-06 12.1948C8.0434e-06 2.99417 2.7602 -4.36629 8.28054 -9.88665C13.8009 -15.407 20.9773 -18.1672 29.8099 -18.1672C40.1145 -18.1672 48.2111 -14.3029 54.0994 -6.57441C59.9878 1.5221 62.932 11.2747 62.932 22.6834C62.932 35.5642 59.9878 48.2611 54.0994 60.7738C48.2111 73.6546 40.4826 84.3273 30.914 92.7918Z"
			fill="<?php echo $type === 'light_quotes' ? '#CED7E1' : '#191F47' ?>" />
	</svg>

	<div class="items-end gap-2 hidden lg:flex">
		<button class="testimonials-slider-prev bg-white rounded-full p-3 cursor-pointer disabled:bg-[#E7ECF1]">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g>
					<path d="M12 7C10.093 10.0531 7.21964 11.9966 4 11.9966C7.21964 11.9966 10.093 13.94 12 17"
						stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
					<path d="M4 12L20 12" stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
				</g>
			</svg>
		</button>
		<button class="testimonials-slider-next bg-white rounded-full p-3 cursor-pointer disabled:bg-[#E7ECF1]">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M12 7C13.907 10.0531 16.7804 11.9966 20 11.9966C16.7804 11.9966 13.907 13.94 12 17"
					stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
				<path d="M20 12L4 12" stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
			</svg>
		</button>
	</div>
	<div class="max-w-[52.9375rem] w-full">

		<div class="swiper-pagination testimonials-slider-pagination !static !w-max mb-8 lg:mb-12"></div>
		<div class="swiper testimonials-slider">
			<div class="swiper-wrapper">
				<?php foreach ( $testimonials as $testimonial ) : ?>
					<div class="swiper-slide">
						<div class="flex flex-col">
							<div class="text-title-s lg:text-title-m font-argent mb-8 lg:mb-[6.625rem]">
								<?php echo $testimonial['text'] ?>
							</div>
							<div class="flex items-center gap-2 lg:gap-6">
								<?php if ( $testimonial['image'] ) : ?>
									<img src="<?php echo esc_url( $testimonial['image']['url'] ); ?>"
										alt="<?php echo esc_attr( $testimonial['image']['alt'] ); ?>"
										class="w-[5rem] h-[5rem] rounded-full shrink-0" />
								<?php endif; ?>
								<div>
									<p class="text-body-m-medium font-semibold">
										<?php echo esc_html( $testimonial['name'] ); ?>
									</p>
									<p class="text-body-m-light"><?php echo esc_html( $testimonial['subtext'] ); ?></p>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>