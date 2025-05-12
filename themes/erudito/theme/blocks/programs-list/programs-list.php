<?php
/**
 * Programs List Block
 *
 * @package erudito
 */

$heading = get_field( 'heading' );

?>
<div class="pt-12 lg:pt-26 px-5 lg:px-20">
	<?php if ( $heading ) : ?>
		<h2 class="text-title-l-mobile lg:text-title-l lg:text-center mb-8 lg:mb-12 max-w-[40.375rem] mx-auto">
			<?php echo esc_html( $heading ); ?>
		</h2>
	<?php endif; ?>
	<div>
		<?php
		$programs = get_posts( array(
			'post_type' => 'program',
			'posts_per_page' => -1,
			'orderby' => 'menu_order',
			'order' => 'ASC',
		) );
		?>
		<?php if ( $programs ) : ?>
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16 grid-rows-1">
				<?php foreach ( $programs as $program ) :
					$classes = get_field( 'classes', $program->ID );
					?>
					<div class="h-auto flex flex-col justify-between">
						<div>
							<?php if ( has_post_thumbnail( $program->ID ) ) : ?>
								<img src="<?php echo esc_url( get_the_post_thumbnail_url( $program->ID ) ); ?>"
									alt="<?php echo esc_attr( get_the_title( $program->ID ) ); ?>"
									class="w-full h-auto mb-6 aspect-[384/262]" />
							<?php endif; ?>
							<h2 class="text-title-m-mobile lg:text-title-s">
								<?php echo esc_html( get_the_title( $program->ID ) ); ?>
							</h2>
							<?php if ( $classes ) : ?>
								<p class="text-title-xs mb-4">
									<?php echo esc_html( $classes ); ?>
								</p>
							<?php endif; ?>
							<p class="text-body-m-light mb-6"><?php echo esc_html( get_the_excerpt( $program->ID ) ); ?></p>
						</div>
						<div class="flex gap-4 items-center justify-start">
							<a href="<?php echo esc_url( get_permalink( $program->ID ) ); ?>" class="erd_button">
								<?php esc_html_e( 'Plačiau', 'erd' ); ?>
							</a>
							<a href="<?php echo esc_url( get_permalink( $program->ID ) ); ?>" class="font-semibold">
								<?php esc_html_e( 'Apie priėmimą', 'erd' ); ?>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="text-body-m-light">No programs found.</p>
		<?php endif; ?>
	</div>
</div>