<?php
/**
 * Content slider Block
 *
 * @package erudito
 */

$heading          = get_field( 'heading' );
$description      = get_field( 'description' );
$background_color = get_field( 'background_color' );
$items            = get_field( 'items' );
$type             = get_field( 'type' );
$column_count     = get_field( 'column_count' );
$bordered         = get_field( 'bordered' );

if ( ! function_exists( 'icons_item' ) ) {
	function icons_item( $icon, $title, $description ) {
		?>
		<div
			class="border-t border-t-gray3 first-of-type:border-t-0 py-8 lg:py-0 first-of-type:pt-0 last-of-type:pb-0 lg:border-t-0 lg:border-r lg:border-r-gray3 lg:px-12 lg:first-of-type:pl-0 lg:last-of-type:pr-0 [&:nth-child(3n+4)]:pl-0">
			<?php if ( $icon ) : ?>
				<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>"
					class="aspect-square w-[4.5rem] lg:w-[5.5rem] mb-4 lg:mb-8" />
			<?php endif; ?>
			<h3 class="text-title-m-mobile lg:text-title-m mb-2 lg:mb-4">
				<?php echo esc_html( $title ); ?>
			</h3>
			<p><?php echo esc_html( $description ); ?></p>
		</div>
		<?php
	}
}

if ( ! function_exists( 'icons_slider_item' ) ) {
	function icons_slider_item( $icon, $title, $description ) {
		?>
		<div class="swiper-slide w-auto">
			<?php if ( $icon ) : ?>
				<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>"
					class="aspect-square w-[4.5rem] lg:w-[5.5rem] mb-4 lg:mb-8" />
			<?php endif; ?>
			<h3 class="text-title-m-mobile lg:text-title-m mb-2 lg:mb-4">
				<?php echo esc_html( $title ); ?>
			</h3>
			<p><?php echo esc_html( $description ); ?></p>
		</div>
		<?php
	}
}

?>

<div class="px-5 lg:px-20 py-12 lg:py-26" style="background-color: <?php echo esc_attr( $background_color ); ?>;">
	<div class="">
		<div class="mb-8 lg:mb-20">
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-l lg:max-w-[21.5625rem]">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="text-body-m-light mt-4 lg:mt-6 lg:max-w-[35.5rem]">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
		</div>
		<?php if ( $items ) : ?>
			<div class="swiper content-slider lg:hidden">
				<div class="swiper-wrapper">
					<?php foreach ( $items as $index => $item ) : ?>
						<?php icons_slider_item( $item['icon'], $item['title'], $item['description'] ); ?>
					<?php endforeach; ?>
				</div>
				<div class="content-slider-pagination mt-10"></div>
			</div>
		<?php endif; ?>
		<?php if ( $items ) : ?>
			<div class="hidden lg:grid grid-cols-1 lg:gap-y-16 lg:grid-cols-<?php echo esc_attr( $column_count ); ?>">
				<?php foreach ( $items as $index => $item ) : ?>
					<?php icons_item( $item['icon'], $item['title'], $item['description'] ); ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>