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

$type = get_field( 'type' );

if ( ! function_exists( 'centered_hero_section' ) ) {
	function centered_hero_section() {
		$icon         = get_field( 'icon' );
		$heading      = get_field( 'heading' );
		$description  = get_field( 'description' );
		$image_center = get_field( 'image_center' );
		$button       = get_field( 'button' );
		?>
		<div class="lg:px-20 pt-12 lg:pt-20 text-black">
			<div class="px-5 lg:px-0 mb-16 max-w-[40.5rem] mx-auto">
				<?php if ( $icon ) : ?>
					<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>"
						class="w-auto h-[4rem] mb-8 mx-auto" />
				<?php endif; ?>
				<?php if ( $heading ) : ?>
					<h2 class="text-title-l-mobile lg:text-title-xl text-center mb-4 lg:mb-6">
						<?php echo esc_html( $heading ); ?>
					</h2>
				<?php endif; ?>
				<?php if ( $description ) : ?>
					<p class="text-body-m-light text-center mb-6 lg:mb-8">
						<?php echo esc_html( $description ); ?>
					</p>
				<?php endif; ?>
				<?php if ( $button ) : ?>
					<div class="justify-center flex">
						<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
							<?php echo esc_html( $button['title'] ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( $image_center ) : ?>
				<img src="<?php echo esc_url( $image_center['url'] ); ?>" alt="<?php echo esc_attr( $image_center['alt'] ); ?>"
					class="w-full mt-8 lg:mt-9" />
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
	<div class="relative lg:px-20 py-12 lg:py-26 text-white">
		<?php if ( $image_left ) : ?>
			<img src="<?php echo esc_url( $image_left['url'] ); ?>" alt="<?php echo esc_attr( $image_left['alt'] ); ?>"
				class="absolute top-[2.125rem] left-0 w-full h-auto max-w-[18.75rem] hidden lg:block" />
		<?php endif; ?>
		<?php if ( $image_right ) : ?>
			<img src="<?php echo esc_url( $image_right['url'] ); ?>" alt="<?php echo esc_attr( $image_right['alt'] ); ?>"
				class="absolute bottom-0 right-0 w-full h-auto max-w-[21.875rem] hidden lg:block" />
		<?php endif; ?>
		<div>
			<div class="px-5 lg:px-0 mb-16 max-w-[40.5rem] mx-auto">
				<?php if ( $heading ) : ?>
					<h2 class="text-title-l-mobile lg:text-title-xl text-center mb-4 lg:mb-6">
						<?php echo esc_html( $heading ); ?>
					</h2>
				<?php endif; ?>
				<?php if ( $description ) : ?>
					<p class="text-body-m-light text-center mb-6 lg:mb-8">
						<?php echo esc_html( $description ); ?>
					</p>
				<?php endif; ?>
				<?php if ( $button ) : ?>
					<div class="justify-center hidden lg:flex">
						<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
							<?php echo esc_html( $button['title'] ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
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
		<div class="pt-10 pb-12 lg:pb-26 px-5 lg:px-20">
			<div class="border-t border-white/15 flex flex-col lg:flex-row justify-between pt-12 lg:pt-20 gap-8">
				<div>
					<?php esc_html_e( 'Apie programą', 'erudito' ); ?>
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
			<?php endif; ?>
		</div>
	</div>
</div>