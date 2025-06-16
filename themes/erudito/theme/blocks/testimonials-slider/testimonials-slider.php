<?php
/**
 * Testimonials Slider Block
 *
 * @package erudito
 */

$testimonials = get_field( 'testimonials' );
$type         = get_field( 'type' );
$image        = 'data:image/svg+xml,%3Csvg%20width%3D%221256%22%20height%3D%22296%22%20viewBox%3D%220%200%201256%20296%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M1435%2034.8795L1211.45%20-405.293L948.751%20-271.877L980.927%20-372.122L510.862%20-523L426.336%20-259.66C381.156%20-298.538%20322.364%20-322.039%20258.084%20-322.039C115.549%20-322.039%200.000962727%20-206.492%200.000956497%20-63.9565C0.000950267%2078.5786%20115.549%20194.126%20258.084%20194.126C269.002%20194.126%20279.762%20193.448%20290.323%20192.132L302.186%20295.745L727.568%20247.044L705.937%2058.1078L830.049%2097.9443L862.297%20-2.52554L994.828%20258.429L1435%2034.8795Z%22%20fill%3D%22white%22%2F%3E%3C%2Fsvg%3E';

if ( ! $testimonials ) {
	return;
}

if ( ! $type ) {
	$type = 'light_quotes';
}
?>

<div class="bg-gray pb-12 pt-30 lg:py-20 px-5 lg:px-20 flex justify-between relative"
	style="background-image: url(<?php echo $image; ?>); background-repeat: no-repeat; background-size: 80%; background-position: top right;">
	<svg class="absolute left-3 lg:left-20 -top-2 lg:-top-4 w-[7.5rem] h-auto lg:w-[8.75rem]" width="140" height="114"
		viewBox="0 0 140 114" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path
			d="M107.982 110.959C106.51 112.431 105.038 113.167 103.566 113.167C102.094 113.167 100.806 112.431 99.7015 110.959L95.2852 105.439C100.806 99.9182 105.406 93.1097 109.086 85.0132C112.398 77.2847 114.054 69.7403 114.054 62.3798C114.054 59.8036 113.686 57.9635 112.95 56.8594C109.27 57.5955 106.326 57.9635 104.118 57.9635C96.7573 57.9635 90.5009 55.2033 85.3486 49.683C79.8282 44.5306 77.068 38.0902 77.068 30.3618C77.068 21.1612 79.8282 13.8007 85.3486 8.28035C90.8689 2.76001 98.0454 -0.000156256 106.878 -0.000155484C117.183 -0.000154583 125.279 3.8641 131.167 11.5926C137.056 19.6891 140 29.4417 140 40.8504C140 53.7312 137.056 66.4281 131.167 78.9408C125.279 91.8216 117.551 102.494 107.982 110.959ZM30.914 110.959C29.4419 112.431 27.9698 113.167 26.4977 113.167C25.0256 113.167 23.7375 112.431 22.6334 110.959L18.2172 105.438C23.7375 99.9182 28.3378 93.1097 32.018 85.0132C35.3302 77.2847 36.9863 69.7402 36.9863 62.3798C36.9863 59.8036 36.6183 57.9635 35.8823 56.8594C32.202 57.5955 29.2579 57.9635 27.0497 57.9635C19.6893 57.9635 13.4329 55.2033 8.28054 49.683C2.7602 44.5306 6.56342e-06 38.0902 7.23906e-06 30.3618C8.0434e-06 21.1612 2.7602 13.8007 8.28054 8.28035C13.8009 2.76 20.9773 -0.000162993 29.8099 -0.000162221C40.1145 -0.00016132 48.2111 3.8641 54.0994 11.5926C59.9878 19.6891 62.932 29.4417 62.932 40.8504C62.932 53.7312 59.9878 66.428 54.0994 78.9408C48.2111 91.8216 40.4826 102.494 30.914 110.959Z"
			fill="<?php echo $type === 'light_quotes' ? '#CED7E1' : '#191F47' ?>" />
	</svg>


	<div class="items-end gap-2 hidden lg:flex">
		<button
			class="erd_icon_button testimonials-slider-prev before:bg-white rounded-full p-3 cursor-pointer disabled:before:bg-[#E7ECF1]">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g>
					<path d="M12 7C10.093 10.0531 7.21964 11.9966 4 11.9966C7.21964 11.9966 10.093 13.94 12 17"
						stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
					<path d="M4 12L20 12" stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
				</g>
			</svg>
		</button>
		<button
			class="testimonials-slider-next erd_icon_button before:bg-white rounded-full p-3 cursor-pointer disabled:before:bg-[#E7ECF1]">
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