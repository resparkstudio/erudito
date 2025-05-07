<?php
/**
 * Content Section Block
 *
 * @package erudito
 */

$heading          = get_field( 'heading' );
$description      = get_field( 'description' );
$background_color = get_field( 'background_color' );
$items            = get_field( 'items' );
$type             = get_field( 'type' );
$column_count     = get_field( 'column_count' );

if ( ! function_exists( 'numbers_item' ) ) {
	function numbers_item( $index, $title, $description ) {
		?>
		<div
			class="border-t border-t-gray3 first-of-type:border-t-0 py-8 lg:py-0 first-of-type:pt-0 last-of-type:pb-0 lg:border-t-0 lg:border-r lg:border-r-gray3 lg:last-of-type:border-r-0 lg:px-10 lg:first-of-type:pl-0 lg:last-of-type:pr-0">
			<?php if ( $index ) : ?>
				<div class="text-title-l lg:text-title-xl mb-5 lg:mb-10 flex font-argent text-gray3">
					0<?php echo esc_html( $index ); ?>
				</div>
			<?php endif; ?>
			<p class="	text-body-m-light lg:text-subtitle-mobile mb-1 lg:mb-2">
				<?php echo esc_html( $title ); ?>
			</p>
			<p><?php echo esc_html( $description ); ?></p>
		</div>
		<?php
	}
}

if ( ! function_exists( 'icons_item' ) ) {
	function icons_item( $icon, $title, $description ) {
		?>
		<div
			class="border-t border-t-gray3 first-of-type:border-t-0 py-8 lg:py-0 first-of-type:pt-0 last-of-type:pb-0 lg:border-t-0">
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
			<div
				class="grid grid-cols-1 lg:grid-cols-<?php echo esc_attr( $column_count ); ?> <?php echo 'icons' === $type ? 'lg:gap-16' : '' ?>">
				<?php foreach ( $items as $index => $item ) : ?>
					<?php if ( 'numbers' === $type ) : ?>
						<?php numbers_item( index: $index + 1, title: $item['title'], description: $item['description'] ); ?>
					<?php elseif ( 'icons' === $type ) : ?>
						<?php icons_item( $item['icon'], $item['title'], $item['description'] ); ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>