<?php
/**
 * Career cards Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );

$cards = get_field( 'cards' );

if ( ! function_exists( 'testimonial_card' ) ) {
	function testimonial_card( $card ) {
		?>
		<div class="relative w-full max-w-[18.625rem] lg:max-w-[24rem] min-h-[22.25rem] lg:min-h-[28.75rem] bg-white">
			<svg class="absolute -top-8 left-10 rotate-5" width="94" height="93" viewBox="0 0 94 93" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<path
					d="M70.0407 71.1762C69.3794 72.0299 68.6699 72.5049 67.9123 72.601C67.1547 72.6972 66.4438 72.4026 65.7794 71.7172L63.1461 69.1648C65.6263 65.9633 67.5489 62.159 68.9138 57.7519C70.1134 53.5583 70.4728 49.5676 69.9919 45.7797C69.8236 44.454 69.514 43.5311 69.0631 43.011C67.2173 43.6302 65.7262 44.0119 64.5898 44.1562C60.802 44.6371 57.402 43.6254 54.3898 41.1211C51.2123 38.8303 49.3711 35.6962 48.8662 31.719C48.2651 26.9842 49.2047 23.0161 51.6849 19.8145C54.1651 16.613 57.6779 14.7237 62.2233 14.1466C67.5263 13.4734 71.9454 14.9331 75.4806 18.5256C79.0398 22.3075 81.1921 27.134 81.9375 33.0052C82.779 39.6339 82.0934 46.3603 79.8806 53.1843C77.6919 60.1977 74.4119 66.195 70.0407 71.1762ZM30.38 76.2112C29.7186 77.065 29.0092 77.5399 28.2516 77.6361C27.494 77.7323 26.7831 77.4376 26.1187 76.7522L23.4854 74.1999C25.9656 70.9983 27.8882 67.194 29.2531 62.7869C30.4527 58.5933 30.8121 54.6026 30.3312 50.8148C30.1629 49.489 29.8533 48.5661 29.4024 48.046C27.5565 48.6652 26.0655 49.047 24.9291 49.1913C21.1413 49.6721 17.7413 48.6604 14.7291 46.1562C11.5516 43.8653 9.71042 40.7313 9.2055 36.7541C8.60441 32.0193 9.54397 28.0511 12.0242 24.8496C14.5044 21.648 18.0172 19.7587 22.5626 19.1817C27.8656 18.5085 32.2847 19.9681 35.8199 23.5606C39.3791 27.3426 41.5314 32.1691 42.2768 38.0402C43.1183 44.669 42.4327 51.3953 40.2199 58.2194C38.0312 65.2328 34.7512 71.2301 30.38 76.2112Z"
					fill="#CED7E1" />
			</svg>
			<div class="flex flex-col justify-between p-5 lg:p-10 min-h-[22.25rem] lg:min-h-[28.75rem]">
				<p class="text-title-m-mobile lg:text-title-m font-argent">
					<?php echo esc_html( $card['testimonial_text'] ); ?>
				</p>
				<div class="flex items-center gap-2 lg:gap-6">
					<?php if ( $card['person']['image'] ) : ?>
						<img src="<?php echo esc_url( $card['person']['image']['url'] ); ?>"
							alt="<?php echo esc_attr( $card['person']['image']['alt'] ); ?>"
							class="w-16 h-16 lg:w-[5rem] lg:h-[5rem] rounded-full shrink-0 object-cover" />
					<?php endif; ?>
					<div>
						<p class="text-body-m-medium font-semibold">
							<?php echo esc_html( $card['person']['name'] ); ?>
						</p>
						<p class="text-body-s-light"><?php echo esc_html( $card['person']['position'] ); ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'video_card' ) ) {
	function video_card( $card ) {
		?>
		<div class="relative aspect-[298/356] lg:aspect-[384/460] max-w-[18.625rem] lg:max-w-[24rem] w-full">
			<img src="<?php echo esc_url( $card['thumbnail']['url'] ) ?>" alt=""
				class="w-full aspect-[298/356] lg:aspect-[384/460] object-cover">
			<div
				class="absolute bottom-6 right-6 w-[4rem] h-[4rem] -rotate-5 rounded-full bg-yellow flex items-center justify-center">
				<svg width="9" height="14" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9.98821 8.86053L0.121466 14.5743L2.02148 0.703857L9.98821 8.86053Z" fill="#181B2B" />
				</svg>

			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'image_card' ) ) {
	function image_card( $card ) {
		?>
		<div
			class="relative aspect-[298/356] lg:aspect-[384/460] max-w-[18.625rem] lg:max-w-[24rem] w-full min-h-[22.25rem] lg:min-h-[28.75rem]">
			<img src="<?php echo esc_url( $card['image']['url'] ) ?>" alt=""
				class="w-full aspect-[298/356] lg:aspect-[384/460] object-cover">
		</div>
		<?php
	}
}

?>
<div class="px-5 lg:px-20 py-12 lg:py-26 bg-gray">
	<div class="max-w-[32.625rem] lg:mb-16 text-center mx-auto pb-[4.375rem]">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="text-body-m-light mb-6">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
	</div>
	<div class="flex flex-col items-center gap-6 lg:gap-0">
		<?php foreach ( $cards as $index => $card ) : ?>
			<div
				class="odd:lg:translate-x-2/3 even:lg:-translate-x-2/3 <?php echo $index % 2 === 0 ? 'career-card-odd' : 'career-card-even'; ?>">
				<?php
				switch ( $card['type'] ) {
					case 'testimonial':
						testimonial_card( $card );
						break;
					case 'video':
						video_card( $card );
						break;
					case 'image':
						image_card( $card );
						break;
					default:
						break;
				}
				?>
			</div>
		<?php endforeach; ?>
	</div>
</div>