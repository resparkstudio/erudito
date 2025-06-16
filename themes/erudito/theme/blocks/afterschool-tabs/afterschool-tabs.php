<?php
/**
 * Afterschool Tabs Block
 *
 * @package erudito
 */

$all_categories_text = get_field( 'all_categories_text' );
$tabs                = get_field( 'tabs' );

if ( ! $tabs ) {
	return;
}

?>

<div x-data="{openTab: 0}">
	<div class="px-5 lg:px-20 bg-gray w-full flex">
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<?php erd_tab( $index, $tab['tab_name'] ); ?>
		<?php endforeach; ?>
	</div>
	<div class="px-5 lg:px-20 py-12 lg:pt-16 lg:pb-26">
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<div x-data="{openCategory: 'all_categories'}" x-show="openTab === <?php echo $index; ?>">
				<div class="swiper tab-slider !w-auto lg:flex flex-wrap gap-0.5">
					<div class="swiper-wrapper !w-auto">
						<button
							class="swiper-slide py-[0.625rem] px-4 lg:px-5  rounded-full text-gray4 cursor-pointer font-medium w-max"
							x-bind:class="{ '!text-black bg-gray' : openCategory === 'all_categories' }"
							@click="openCategory = 'all_categories'">
							<?php echo esc_html( $all_categories_text ); ?>
						</button>
						<?php foreach ( $tab['categories'] as $category ) : ?>
							<button
								class="swiper-slide w-max px-4 lg:px-5 py-[0.625rem] hover:text-black rounded-full font-medium text-gray4 cursor-pointer transition-all duration-200 ease-in-out"
								x-bind:class="{ '!text-black !bg-gray' : openCategory === '<?php echo $category['category_name']; ?>' }"
								@click="openCategory = '<?php echo $category['category_name']; ?>'">
								<?php echo esc_html( $category['category_name'] ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="grid grid-cols-1 lg:grid-cols-2 gap-x-20 gap-y-10 lg:gap-y-16 mt-8 lg:mt-12">
					<?php foreach ( $tab['categories'] as $category ) : ?>
						<?php if ( $category['activities'] ) : ?>
							<?php foreach ( $category['activities'] as $activity ) : ?>
								<div
									x-show="openCategory === '<?php echo $category['category_name']; ?>' || openCategory === 'all_categories'">
									<?php if ( $activity['image'] ) : ?>
										<img src="<?php echo esc_url( $activity['image']['url'] ); ?>"
											alt="<?php echo esc_attr( $activity['image']['alt'] ); ?>"
											class="w-full mb-4 lg:mb-8 aspect-[600/400] object-cover" />
									<?php endif; ?>
									<div class="hidden lg:block">
										<div>
											<h3 class="text-title-m-mobile lg:text-title-m mb-2">
												<?php echo esc_html( $activity['title'] ); ?>
											</h3>
										</div>
										<div class="text-body-m-light">
											<?php echo esc_html( $activity['description'] ); ?>
										</div>
									</div>
									<div class="lg:hidden" x-data="{open: false}">
										<button
											class="text-title-s-mobile font-argent flex justify-between w-full items-center gap-4 group cursor-pointer text-left"
											type="button" @click="open = !open">
											<?php echo esc_html( $activity['title'] ); ?>
											<div
												class="group-hover:bg-gray group-hover:rounded-full p-1 transition-all duration-300 ease-in-out">
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
										</button>
										<div x-show="open" x-collapse>
											<div class="text-body-m-light pt-2">
												<?php echo esc_html( $activity['description'] ); ?>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>