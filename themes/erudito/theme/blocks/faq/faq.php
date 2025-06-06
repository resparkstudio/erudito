<?php
/**
 * FAQ Block
 *
 * @package erudito
 */

$heading   = get_field( 'heading' );
$faq_items = get_field( 'faq_items' );
$button    = get_field( 'button' );

$background_color = get_field( 'background_color' );

if ( ! $background_color ) {
	$background_color = '#F3F5F9';
}
?>

<div class="px-5 lg:px-20 py-12 lg:py-26 bg-gray flex flex-col lg:flex-row lg:gap-[8rem]"
	style="background-color: <?php echo esc_attr( $background_color ); ?>;">
	<div class="max-w-[25.8125rem]">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l mb-4">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
	</div>
	<div class="w-full">
		<div>

			<?php if ( $faq_items ) : ?>
				<?php foreach ( $faq_items as $index => $item ) : ?>
					<?php erd_accordion_item( $item['question'], $item['answer'], $index ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<?php if ( $button ) : ?>
			<div class="mt-8 lg:mt-12">
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
					<?php echo esc_html( $button['title'] ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>