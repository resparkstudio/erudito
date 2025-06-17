<?php
/**
 * Hero Section Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$button      = get_field( 'button' );
$image_left  = get_field( 'image_left' );
$image_right = get_field( 'image_right' );
$type        = get_field( 'type' );

$background_image = 'data:image/svg+xml,%3Csvg%20width%3D%221023%22%20height%3D%22480%22%20viewBox%3D%220%200%201023%20480%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M874.98%20150.076C922.465%2068.7511%201007.25%2010.8369%201108.18%201.69501C1273.94%20-13.3176%201420.48%20108.881%201435.49%20274.633C1450.5%20440.386%201328.3%20586.925%201162.55%20601.938C1063.6%20610.9%20971.5%20570.964%20910.139%20502.056L841.368%20674.439L543.162%20555.471L215.103%20725.309L0.708824%20311.187L459.576%2073.6286L506.854%20164.95L562.518%2025.4212L874.98%20150.076Z%22%20fill%3D%22%23191F47%22%2F%3E%3C%2Fsvg%3E';

if ( ! function_exists( 'erd_hero_content' ) ) {
	function erd_hero_content( $heading, $description ) {
		?>
		<div class=" px-5 lg:px-0 mb-16 max-w-[40.5rem] mx-auto">
			<?php if ( $heading ) : ?>
				<h2 class="hero-text-content text-title-l-mobile lg:text-title-xl text-center mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="hero-text-content text-body-m-light text-center mb-6 lg:mb-8">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
			<div class="hero-text-content justify-center flex">
				<?php erd_register_button(); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'centered_hero_section' ) ) {
	function centered_hero_section() {
		$icon         = get_field( 'icon' );
		$heading      = get_field( 'heading' );
		$description  = get_field( 'description' );
		$image_center = get_field( 'image_center' );
		?>
		<div class="px-5 lg:px-20 pt-12 lg:pt-20 text-black">
			<?php if ( $icon ) : ?>
				<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>"
					class="w-auto h-[4rem] mb-8 mx-auto" />
			<?php endif; ?>
			<?php erd_hero_content( $heading, $description ); ?>
			<?php if ( $image_center ) : ?>
				<div class="max-w-[44rem] w-full mx-auto">
					<img src="<?php echo esc_url( $image_center['url'] ); ?>" alt="<?php echo esc_attr( $image_center['alt'] ); ?>"
						class="w-full mt-8 lg:mt-9 " />
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}

if ( 'centered' === $type ) {
	centered_hero_section();
	return;
}
?>

<div>
	<div class="relative lg:px-20 py-12 lg:py-26 text-white overflow-hidden">
		<?php if ( $image_left ) : ?>
			<img src="<?php echo esc_url( $image_left['url'] ); ?>" alt="<?php echo esc_attr( $image_left['alt'] ); ?>"
				class="hero-image-left absolute top-[2.125rem] -left-6 w-full h-auto max-w-[18.75rem] hidden lg:block" />
		<?php endif; ?>
		<?php if ( $image_right ) : ?>
			<img src="<?php echo esc_url( $image_right['url'] ); ?>" alt="<?php echo esc_attr( $image_right['alt'] ); ?>"
				class="hero-image-right absolute -bottom-6 -right-6 w-full h-auto max-w-[21.875rem] hidden lg:block" />
		<?php endif; ?>
		<div>
			<?php erd_hero_content( $heading, $description ); ?>
			<?php if ( $image_left ) : ?>
				<img src="<?php echo esc_url( $image_left['url'] ); ?>" alt="<?php echo esc_attr( $image_left['alt'] ); ?>"
					class="w-full lg:hidden" />
			<?php endif; ?>
		</div>
	</div>

	<?php if ( 'with_program_info' === $type ) :
		$large_text = get_field( 'large_text' );
		$small_text = get_field( 'small_text' );
		?>
		<div class="pt-10 pb-12 lg:pb-26 px-5 lg:px-20 relative"
			style="background-image: url(<?php echo $background_image; ?>); background-repeat: no-repeat; background-size: 80%; background-position: bottom right;">
			<div class="border-t border-white/15 flex flex-col lg:flex-row justify-between pt-12 lg:pt-20 gap-8">
				<div>
					<?php esc_html_e( 'Apie programą', 'erd' ); ?>
				</div>
				<div class="max-w-[45.375rem] flex flex-col justify-center">
					<div>
						<?php if ( $large_text ) : ?>
							<h2 class="text-[1.5rem] leading-[1.75rem] lg:text-[2.5rem] lg:leading-[3rem] mb-4 lg:mb-8">
								<?php echo esc_html( $large_text ); ?>
							</h2>
						<?php endif; ?>
						<?php if ( $small_text ) : ?>
							<p class="text-body-m-light">
								<?php echo esc_html( $small_text ); ?>
							</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>