<?php
/**
 * CTA With Shapes Block
 *
 * @package erudito
 */

$heading_array = get_field( 'heading_array' );
$description   = get_field( 'description' );
$button        = get_field( 'button' );
$icon          = get_field( 'icon' );

if ( ! function_exists( 'cta_icon_1' ) ) {
	function cta_icon_1() {
		?>
		<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"
			class="w-[1.75rem] h-[1.75rem] lg:w-16 lg:h-16">
			<circle cx="32" cy="32" r="32" fill="#F0CB69" />
		</svg>
		<?php
	}
}

if ( ! function_exists( 'cta_icon_2' ) ) {
	function cta_icon_2() {
		?>
		<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"
			class="w-[1.625rem] h-[1.625rem] lg:w-[3.75rem] lg:h-[3.75rem]">
			<rect width="60" height="60" fill="#6A69B4" />
		</svg>
		<?php
	}
}

if ( ! function_exists( 'cta_icon_3' ) ) {
	function cta_icon_3() {
		?>
		<svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg"
			class="w-[1.625rem] h-[1.625rem] lg:w-[3.5rem] lg:h-[3.5rem]">
			<rect width="56" height="56" fill="#191F47" />
		</svg>
		<?php
	}
}
?>

<div class="bg-blue px-5 lg:px-20 pt-12 pb-16 lg:pb-42 lg:pt-26 relative">
	<div class="border-b border-b-white/15 pb-10 lg:pb-20">
		<?php if ( $heading_array ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l flex flex-wrap gap-x-3 lg:gap-x-6 max-w-[70.125rem]">
				<?php foreach ( $heading_array as $index => $heading ) : ?>
					<span class="text-white"><?php echo esc_html( $heading['text'] ); ?></span>
					<?php
					// Add an icon after each array item
					switch ( $index % 3 ) {
						case 0:
							cta_icon_1();
							break;
						case 1:
							cta_icon_2();
							break;
						case 2:
							cta_icon_3();
							break;
					}
					?>
				<?php endforeach; ?>
			</h2>
		<?php endif; ?>
	</div>
	<div class="flex flex-col lg:flex-row gap-8 w-full justify-between items-start pt-10 lg:pt-20">
		<?php if ( $icon ) : ?>
			<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>"
				class="w-auto h-[5.0625rem]" />
		<?php endif; ?>
		<div class="max-w-[32.625rem]">
			<?php if ( $description ) : ?>
				<p class="text-body-m-light text-white mb-6 lg:mb-10">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
			<?php if ( $button ) : ?>
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
					<?php echo esc_html( $button['title'] ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>