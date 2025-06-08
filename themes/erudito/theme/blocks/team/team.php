<?php
/**
 * Team Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );

$tabs = get_field( 'tabs' );
?>

<div x-data="{openTab: 0}" class="pb-12 lg:pb-26 w-full ">
	<div class="px-5 lg:px-20 pt-12 lg:pt-26 bg-gray">
		<div class="pb-16">
			<?php erd_section_text( $heading, $description, null, '32.625rem' ); ?>
		</div>
		<div class="w-full flex">
			<?php foreach ( $tabs as $index => $tab ) : ?>
				<?php erd_tab( $index, $tab['city_name'] ); ?>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="px-5 lg:px-20 pt-10 lg:pt-20 w-full">
		<?php foreach ( $tabs as $tab ) : ?>
			<div class="flex flex-col lg:flex-row w-full justify-between">
				<div x-show="openTab === <?php echo $index; ?>" class="mb-8" x-cloak>
					<div class=" flex-col hidden lg:flex">
						<?php foreach ( $tab['group'] as $group ) : ?>
							<a href="#" class="py-[0.625rem] px-5 font-medium">
								<?php echo esc_html( $group['group_name'] ); ?>
							</a>
						<?php endforeach; ?>
					</div>
					<div class="swiper tab-slider !w-auto lg:hidden">
						<div class="swiper-wrapper !w-auto">
							<?php foreach ( $tab['group'] as $group ) : ?>
								<a href="#" class="w-max py-[0.625rem] px-5 font-medium swiper-slide">
									<?php echo esc_html( $group['group_name'] ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div>
					<?php foreach ( $tab['group'] as $group ) : ?>
						<h3 class="text-title-m-mobile lg:text-title-m mb-6 lg:mb-10">
							<?php echo esc_html( $group['group_name'] ); ?>
						</h3>
						<?php if ( $group['people'] ) : ?>
							<div class="grid grid-cols-2 lg:grid-cols-[repeat(4,13rem)] gap-y-8 gap-x-4 lg:gap-12 mb-10 lg:mb-20">
								<?php foreach ( $group['people'] as $member ) : ?>
									<div class="flex flex-col lg:pb-5">
										<img src="<?php echo esc_url( $member['image']['url'] ); ?>"
											alt="<?php echo esc_attr( $member['image']['alt'] ); ?>"
											class="w-full max-w-[13rem] lg:aspect-square mb-5" />
										<p class="font-medium mb-1">
											<?php echo esc_html( $member['name'] ); ?>
										</p>
										<p class="text-body-m-light">
											<?php echo esc_html( $member['position'] ); ?>
										</p>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>