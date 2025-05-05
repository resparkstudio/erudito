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
					<div class="w-full border-b border-gray3 first-of-type:border-t first-of-type:border-t-gray3 py-5 lg:py-7"
						x-data="{ open: <?php echo $index === 0 ? 'true' : 'false'; ?> }">
						<h2 id="heading-<?php echo esc_attr( $index ); ?>">
							<button
								class="text-title-s-mobile lg:text-title-m flex items-center gap-4 lg:gap-6 group cursor-pointer text-left"
								type="button" aria-controls="collapse-<?php echo esc_attr( $index ); ?>" @click="open = !open">
								<div
									class="group-hover:bg-white group-hover:rounded-full p-1 transition-all duration-300 ease-in-out">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg" x-show="open">
										<path d="M19 12L5 12" stroke="black" stroke-width="1.5" stroke-miterlimit="10"
											stroke-linecap="square" />
									</svg>

									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg" x-show="!open">
										<path d="M19 12L5 12" stroke="black" stroke-width="1.5" stroke-miterlimit="10"
											stroke-linecap="square" />
										<path d="M12 5L12 19" stroke="black" stroke-width="1.5" stroke-miterlimit="10"
											stroke-linecap="square" />
									</svg>
								</div>
								<?php echo esc_html( $item['title'] ); ?>
							</button>
						</h2>
						<div id="collapse-<?php echo esc_attr( $index ); ?>"
							aria-labelledby="heading-<?php echo esc_attr( $index ); ?>" x-show="open">
							<div class="text-body-m-light pl-9 lg:pl-12 pt-3 lg:pt-4">
								<?php echo wp_kses_post( $item['description'] ); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>