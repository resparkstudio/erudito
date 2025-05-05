<?php
/**
 * Two Column Section Block
 *
 * @package erudito
 */

$columns = get_field( 'columns' );

if ( ! $columns ) {
	return;
}
?>

<div class="px-5 lg:px-20 py-12 lg:py-26">
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
						<a href="<?php echo esc_url( $column['link']['url'] ); ?>" class="text-caption-semibold">
							<?php echo esc_html( $column['link']['title'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>