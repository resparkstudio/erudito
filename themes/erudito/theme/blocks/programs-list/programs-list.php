<?php
/**
 * Programs List Block
 *
 * @package erudito
 */

$heading          = get_field( 'heading' );
$background_image = get_field( 'background_image' );
$large_item       = get_field( 'large_item' );

if ( ! function_exists( 'large_program_item' ) ) {
	function large_program_item( $top_image, $heading, $description, $button, $link, $image, ) {
		?>
		<div class="w-full">
			<div class="flex flex-col-reverse lg:items-center lg:flex-row gap-6 lg:gap-20 w-full">
				<div class="max-w-[46.125rem]">
					<?php if ( $top_image ) : ?>
						<img src="<?php echo esc_url( $top_image['url'] ); ?>" alt="<?php echo esc_attr( $top_image['alt'] ); ?>"
							class="w-auto h-[2.25rem] mb-6 lg:mb-12" />
					<?php endif; ?>
					<?php if ( $heading ) : ?>
						<h1 class="text-title-m-mobile lg:text-title-l mb-4"><?php echo esc_html( $heading ); ?></h1>
					<?php endif; ?>
					<?php if ( $description ) : ?>
						<p class="text-body-m-light mb-6 lg:mb-8"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
					<div class="flex gap-6 items-center">
						<?php if ( $button ) : ?>
							<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
								<?php echo esc_html( $button['title'] ); ?>
							</a>
						<?php endif; ?>
						<?php if ( $link ) : ?>
							<a href="<?php echo esc_url( $link['url'] ); ?>" class="font-semibold erd_ghost">
								<?php echo esc_html( $link['title'] ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>

				<?php if ( $image ) : ?>
					<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"
						class="w-full" />
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}

?>
<div class="py-12 lg:py-26 px-5 lg:px-20"
	style="background-image: url(<?php echo $background_image['url']; ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">
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
							<a href="<?php echo esc_url( get_permalink( $program->ID ) ); ?>"
								class="font-semibold erd_ghost text-white">
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
	<?php if ( $large_item ) : ?>
		<div class="mt-12 lg:mt-26">
			<?php

			if ( $large_item['type'] === 'custom' ) {
				large_program_item(
					$large_item['top_icon'],
					$large_item['heading'],
					$large_item['description'],
					$large_item['button'],
					$large_item['link'],
					$large_item['image']
				);
			} elseif ( $large_item['type'] === 'program' ) {
				$large_item = get_post( $large_item['large_item'] );
				large_program_item(
					null,
					get_the_title( $large_item->ID ),
					get_the_excerpt( $large_item->ID ),
					array(
						'url' => get_permalink( $large_item->ID ),
						'title' => esc_html__( 'Plačiau', 'erd' ),
					),
					array(
						'url' => get_permalink( $large_item->ID ),
						'title' => esc_html__( 'Apie priėmimą', 'erd' ),
					),
					get_field( 'image', $large_item->ID )
				);
			}
			?>
		</div>
	<?php endif; ?>
</div>