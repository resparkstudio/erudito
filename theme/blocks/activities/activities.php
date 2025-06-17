<?php
/**
 * Activities Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );

$items = get_field( 'items' );

?>

<div class="px-5 lg:px-20 py-12 lg:py-26">
	<div class="mb-8 lg:mb-12 max-w-[39.375rem] text-center mx-auto">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l lg:mb-6">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="text-body-m-light">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
	</div>
	<div x-data="{ openedTab: '0' }">
		<?php if ( $items ) : ?>
			<div class="swiper tab-slider !w-auto lg:flex lg:justify-center">
				<div class="swiper-wrapper !w-auto">
					<?php foreach ( $items as $index => $item ) : ?>
						<button class="swiper-slide w-max text-gray4 py-2.5 px-5 rounded-full cursor-pointer"
							@click="openedTab = '<?php echo esc_attr( $index ); ?>'"
							x-bind:class="{ '!text-black bg-gray': openedTab === '<?php echo esc_attr( $index ); ?>' }">
							<?php echo esc_html( $item['category'] ) ?>
						</button>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-x-20 gap-y-12 lg:gap-y-16">
				<?php foreach ( $items as $index => $item ) : ?>
					<?php if ( $item['activities'] ) : ?>
						<?php foreach ( $item['activities'] as $activity ) : ?>
							<div x-show="openedTab === '<?php echo esc_attr( $index ); ?>'" class="mt-8 lg:mt-12">
								<?php if ( $activity['image'] ) : ?>
									<img src="<?php echo esc_url( $activity['image']['url'] ); ?>"
										alt="<?php echo esc_attr( $activity['image']['alt'] ); ?>" class="w-full mb-6 lg:mb-8" />
								<?php endif; ?>
								<div>
									<h3 class="text-title-m-mobile lg:text-title-m mb-2">
										<?php echo esc_html( $activity['title'] ); ?>
									</h3>
								</div>
								<div class="text-body-m-light">
									<?php echo esc_html( $activity['description'] ); ?>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>