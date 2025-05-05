<?php
/**
 * Three Column Section Block
 *
 * @package erudito
 */

$heading = get_field( 'heading' );
$columns = get_field( 'columns' );

if ( ! $columns ) {
	return;
}
?>

<div class="px-5 lg:px-20 pb-12 lg:pb-26">
	<?php if ( $heading ) : ?>
		<h2 class="text-title-l-mobile lg:text-title-l text-center mb-8 lg:mb-12 max-w-[40.375rem] mx-auto">
			<?php echo esc_html( $heading ); ?>
		</h2>
	<?php endif; ?>
	<div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-10">
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
					<?php if ( $column['button'] ) : ?>
						<a href="<?php echo esc_url( $column['button']['url'] ); ?>" class="erd_button">
							<?php echo esc_html( $column['button']['title'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>