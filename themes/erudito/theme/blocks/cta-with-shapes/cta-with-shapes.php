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
$icon_light    = get_field( 'icon_light' );
$type          = get_field( 'type' );
$image         = 'data:image/svg+xml,%3Csvg%20width%3D%221266%22%20height%3D%22524%22%20viewBox%3D%220%200%201266%20524%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M1445%20557.879L1221.45%20117.707L958.751%20251.123L990.927%20150.878L520.862%20-4.03954e-05L434.103%20270.298C387.998%20227.282%20326.115%20200.959%20258.084%20200.959C115.549%20200.959%200.000962728%20316.506%200.000956497%20459.042C0.000950267%20601.577%20115.549%20717.124%20258.084%20717.124C272.412%20717.124%20286.468%20715.957%20300.161%20713.711L312.186%20818.745L737.568%20770.044L715.937%20581.108L840.049%20620.944L872.297%20520.474L1004.83%20781.429L1445%20557.879Z%22%20fill%3D%22%23191F47%22%2F%3E%3C%2Fsvg%3E';

if ( ! isset( $type ) || empty( $type ) ) {
	$type = 'dark';
}

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

<div class=" px-5 lg:px-20 pt-12 pb-16 lg:pb-42 lg:pt-26 relative <?php echo $type === 'dark' ? 'bg-blue text-white' : 'bg-gray text-black'; ?>"
	style="background-image: url(<?php echo $type === 'dark' ? $image : ''; ?>); background-repeat: no-repeat; background-size: 80%; background-position: bottom right;">
	<div class="border-b pb-10 lg:pb-20 <?php echo $type === 'dark' ? 'border-b-white/15' : 'border-b-gray3'; ?>">
		<?php if ( $heading_array ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-xl flex items-end flex-wrap gap-x-3 max-w-[70.125rem]">
				<?php foreach ( $heading_array as $index => $heading ) :
					//split the text into words and wrap each word in a span
					$words = explode( ' ', $heading['text'] );
					?>
					<?php foreach ( $words as $word ) : ?>
						<span><?php echo esc_html( $word ); ?></span>
					<?php endforeach; ?>
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
			<img src="<?php echo esc_url( $type === 'dark' ? $icon['url'] : $icon_light['url'] ); ?>"
				alt="<?php echo esc_attr( $type === 'dark' ? $icon['alt'] : $icon_light['alt'] ); ?>"
				class="w-auto h-[5.0625rem]" />
		<?php endif; ?>
		<div class="max-w-[32.625rem]">
			<?php if ( $description ) : ?>
				<p class="text-body-m-light mb-6 lg:mb-10">
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