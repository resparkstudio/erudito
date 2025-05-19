<?php
/**
 * FAQ Grouped Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$groups      = get_field( 'groups' );

?>

<div>
	<div class="px-5 lg:px-20 pt-12 lg:pt-26 pb-8 lg:pb-16 bg-gray">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l max-w-[32.625rem]">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="text-body-m-light max-w-[32.625rem] mt-4 lg:mt-6">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
	</div>
	<div class="px-5 lg:px-20 pt-10 lg:pt-20 w-full">
		<div class="flex flex-col lg:flex-row w-full justify-between">
			<div class="mb-8">
				<div class=" flex-col hidden lg:flex">
					<?php foreach ( $groups as $group ) : ?>
						<a href="#" class="py-[0.625rem] px-5 font-medium">
							<?php echo esc_html( $group['group_name'] ); ?>
						</a>
					<?php endforeach; ?>
				</div>
				<div class="swiper tab-slider !w-auto lg:hidden">
					<div class="swiper-wrapper !w-auto">
						<?php foreach ( $groups as $group ) : ?>
							<a href="#" class="w-max py-[0.625rem] px-5 font-medium swiper-slide">
								<?php echo esc_html( $group['group_name'] ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="max-w-[52.875rem] w-full">
				<?php foreach ( $groups as $group ) : ?>
					<h3 class="text-title-m-mobile lg:text-title-m mb-5 lg:mb-7">
						<?php echo esc_html( $group['group_name'] ); ?>
					</h3>
					<?php if ( $group['items'] ) : ?>
						<div class="mb-12 lg:mb-20">
							<?php foreach ( $group['items'] as $index => $item ) : ?>
								<div class="w-full border-t border-gray3 py-5 lg:py-7"
									x-data="{ open: <?php echo $index === 0 ? 'true' : 'false'; ?> }">
									<h2 id="heading-<?php echo esc_attr( $index ); ?>">
										<button
											class="text-title-s-mobile lg:text-title-s flex items-center gap-4 lg:gap-6 group cursor-pointer text-left"
											type="button" aria-controls="collapse-<?php echo esc_attr( $index ); ?>"
											@click="open = !open">
											<div
												class="group-hover:bg-white group-hover:rounded-full p-1 transition-all duration-300 ease-in-out">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
													xmlns="http://www.w3.org/2000/svg" x-show="open" x-cloak>
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
											<?php echo esc_html( $item['question'] ); ?>
										</button>
									</h2>
									<div id="collapse-<?php echo esc_attr( $index ); ?>"
										aria-labelledby="heading-<?php echo esc_attr( $index ); ?>" x-show="open" x-cloak>
										<div class="text-body-m-light pl-9 lg:pl-12 pt-3 lg:pt-4">
											<?php echo wp_kses_post( $item['answer'] ); ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>