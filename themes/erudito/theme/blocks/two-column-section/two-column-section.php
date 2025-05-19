<?php
/**
 * Two Column Section Block
 *
 * @package erudito
 */

$heading          = get_field( 'heading' );
$description      = get_field( 'description' );
$button           = get_field( 'button' );
$background_color = get_field( 'background_color' );
$columns          = get_field( 'columns' );
$text_color       = get_field( 'text_color' );

if ( ! $columns ) {
	return;
}
?>

<div class="px-5 lg:px-20 py-12 lg:py-26"
	style="color: <?php echo esc_attr( $text_color ); ?>; background-color: <?php echo esc_attr( $background_color ); ?>;">
	<div class="text-center max-w-[36.125rem] mx-auto mb-12 lg:mb-20">
		<?php erd_section_text( $heading, $description ); ?>
		<?php if ( $button ) : ?>
			<div class="text-center">
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button mt-6 lg:mt-8">
					<?php echo esc_html( $button['title'] ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
	<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-10">
		<?php foreach ( $columns as $column ) : ?>
			<div class="flex flex-col">
				<?php if ( $column['image'] ) : ?>
					<img src="<?php echo esc_url( $column['image']['url'] ); ?>"
						alt="<?php echo esc_attr( $column['image']['alt'] ); ?>" class="w-full h-auto mb-6 aspect-[600/400]" />
				<?php endif; ?>
				<div class="text-center">
					<h2 class="text-title-m-mobile lg:text-title-m mb-2">
						<?php echo esc_html( $column['title'] ); ?>
					</h2>
					<p class="text-body-m-light mb-6 lg:mb-8">
						<?php echo esc_html( $column['description'] ); ?>
					</p>
					<?php if ( $column['link'] ) : ?>
						<a href="<?php echo esc_url( $column['link']['url'] ); ?>" class="erd_ghost text-caption-semibold">
							<?php echo esc_html( $column['link']['title'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>