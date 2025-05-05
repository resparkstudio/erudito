<?php
/**
 * Schedule Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$items       = get_field( 'items' );

?>

<div class="px-5 lg:px-20 py-12 lg:py-26 bg-gray flex flex-col lg:flex-row gap-8 lg:gap-32">
	<div class="max-w-[25.8125rem]">
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
	<div class="w-full">
		<?php if ( $items ) : ?>
			<div>
				<?php foreach ( $items as $index => $item ) : ?>
					<div
						class="flex gap-6 lg:gap-8 py-7 border-t border-t-gray3 last-of-type:border-b last-of-type:border-b-gray3">
						<div class="shrink-0 relative">
							<?php if ( $item['image'] ) : ?>
								<img src="<?php echo esc_url( $item['image']['url'] ) ?>"
									alt="<?php echo esc_attr( $item['image']['alt'] ); ?>"
									class="w-[6.25rem] lg:w-[9.25rem] aspect-square shrink-0" />
							<?php endif; ?>
							<?php if ( $item['beads'] ) : ?>
								<div class="absolute -top-3 -left-14 w-full h-full flex-col gap-1 hidden lg:flex">
									<?php foreach ( $item['beads'] as $bead ) : ?>
										<div class="bg-white rounded-full text-[0.75rem] leading-[1rem] px-3 py-2 w-max">
											<span class="font-semibold">
												<?php echo esc_html( $bead['time'] ); ?>
											</span>
											<span class="font-light">
												<?php echo esc_html( $bead['title'] ); ?>
											</span>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="w-full lg:flex justify-between">
							<div class="font-argent text-title-s-mobile lg:text-title-m">
								<p>
									<?php echo esc_html( $item['time'] ); ?>
								</p>
								<p>
									<?php echo esc_html( $item['title'] ); ?>
								</p>
							</div>
							<div class="max-w-[19.25rem] mt-2 lg:mt-0">
								<p class="text-body-m-light">
									<?php echo esc_html( $item['description'] ); ?>
								</p>
							</div>
							<?php if ( $item['beads'] ) : ?>
								<div class="flex flex-col gap-1 mt-4 lg:hidden">
									<?php foreach ( $item['beads'] as $bead ) : ?>
										<div class="bg-white rounded-full text-[0.75rem] leading-[1rem] px-3 py-2 w-max">
											<span class="font-semibold">
												<?php echo esc_html( $bead['time'] ); ?>
											</span>
											<span class="font-light">
												<?php echo esc_html( $bead['title'] ); ?>
											</span>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>