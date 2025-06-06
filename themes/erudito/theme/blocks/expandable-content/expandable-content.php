<?php
/**
 * Expandable Content Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$image       = get_field( 'image' );
$items       = get_field( 'items' );

?>

<div class="px-5 lg:px-20 py-12 lg:py-26">
	<div class="mb-8 lg:mb-16 max-w-[37.375rem]">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="text-body-m-light">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
	</div>
	<div class="flex flex-col lg:flex-row gap-8 lg:gap-16">
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"
				class="w-full mb-8 lg:mb-16" />
		<?php endif; ?>

		<?php if ( $items ) : ?>
			<div class="w-full">
				<?php foreach ( $items as $index => $item ) : ?>
					<?php erd_accordion_item( $item['title'], $item['description'], $index, true ); ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>