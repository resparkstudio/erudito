<?php
/**
 * Departments Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$items       = get_field( 'items' );

?>

<div class="px-5 lg:px-20 py-12 lg:py-26 bg-gray">
	<div class="mb-8 lg:mb-16 max-w-[35.625rem] lg:text-center lg:mx-auto">
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
	<div class="hidden lg:grid grid-cols-2 gap-x-20 gap-y-16">
		<?php if ( $items ) : ?>
			<?php foreach ( $items as $item ) : ?>
				<div class="flex flex-col">
					<?php if ( $item['image'] ) : ?>
						<img src="<?php echo esc_url( $item['image']['url'] ); ?>"
							alt="<?php echo esc_attr( $item['image']['alt'] ); ?>" class="w-full mb-10" />
					<?php endif; ?>
					<div class="text-center">
						<h3 class="text-title-m-mobile lg:text-title-m mb-2">
							<?php echo esc_html( $item['title'] ); ?>
						</h3>
						<?php if ( $item['description'] ) : ?>
							<p class="text-body-m-light">
								<?php echo esc_html( $item['description'] ); ?>
							</p>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<div class="swiper departments-slider lg:hidden">
		<div class="swiper-wrapper">
			<?php if ( $items ) : ?>
				<?php foreach ( $items as $item ) : ?>
					<div class="swiper-slide">
						<div class="flex flex-col">
							<?php if ( $item['image'] ) : ?>
								<img src="<?php echo esc_url( $item['image']['url'] ); ?>"
									alt="<?php echo esc_attr( $item['image']['alt'] ); ?>" class="w-full mb-6" />
							<?php endif; ?>
							<div>
								<h3 class="text-title-s-mobile mb-2">
									<?php echo esc_html( $item['title'] ); ?>
								</h3>
								<?php if ( $item['description'] ) : ?>
									<p class="text-body-m-light">
										<?php echo esc_html( $item['description'] ); ?>
									</p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>