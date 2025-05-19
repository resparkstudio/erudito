<?php
/**
 * The template for displaying the mega menu on desktop
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package erudito
 */

$header_type = isset( $args['header_type'] ) ? $args['header_type'] : get_field( 'header_type' );

?>

<nav id="site-navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'erd' ); ?>"
	class="px-6 hidden lg:flex w-full justify-between items-center">
	<?php
	$menu_locations = get_nav_menu_locations();
	$menu_id        = $menu_locations['menu-1'];

	$items = erd_menu_builder( $menu_id );
	$menu  = '';
	?>
	<ul class="flex flex-col lg:flex-row gap-8"><?php
	foreach ( $items as $item ) {
		?>
			<li x-data="{ open: false }" class="group" @mouseenter="open = true" @mouseleave="open = false">
				<a href="<?php echo esc_url( $item['url'] ); ?>"
					class="flex items-center gap-1.5 py-5 border-b border-b-transparent <?php echo $header_type === 'light' ? 'text-black hover:border-b-black' : 'text-white hover:border-b-white' ?>">
					<?php echo esc_html( $item['title'] ); ?>
					<?php if ( $item['children'] ) : ?>
						<svg class="transition-all" x-bind:class="{'rotate-180': open}" width="16" height="16"
							viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4 7L7.99968 9.5L12 7"
								stroke="<?php echo $header_type === 'light' ? '#181B2B' : 'white' ?>" stroke-miterlimit="10"
								stroke-linecap="square" />
						</svg>
					<?php endif; ?>
				</a>
				<?php if ( $item['children'] ) : ?>
					<div x-cloak x-show="open" class="absolute top-full left-0 w-full px-10 z-10" x-transition
						x-transition.duration.200ms>
						<div class="w-full flex">
							<div class="w-full p-8 bg-white flex gap-12">
								<div class="max-w-[19.5rem]">
									<h3 class=" text-title-l-mobile">
										<?php echo esc_html( $item['title'] ); ?>
									</h3>
									<p class="mt-4">
										<?php echo esc_html( get_field( 'description', $item['ID'] ) ); ?>
									</p>
									<a href="<?php echo esc_url( $item['url'] ) ?>" class="erd_button mt-6">
										<?php esc_html_e( 'Plačiau', 'erd' ); ?>
									</a>
								</div>
								<div class="w-full">
									<ul class="flex flex-col w-full">
										<?php
										foreach ( $item['children'] as $child ) {
											?>
											<li
												class=" py-5 border-y border-y-gray3 first:border-t border-t-transparent last:border-b-0 last:pb-0 first:pt-0">
												<a href="<?php echo esc_url( $child['url'] ); ?>"
													class="flex items-center gap-4 w-full justify-between">

													<div>
														<p class="text-title-xs font-argent mb-0.5">
															<?php echo esc_html( $child['title'] ); ?>
														</p>
														<p class="text-caption">
															<?php echo esc_html( get_field( 'description', $child['ID'] ) ); ?>
														</p>
													</div>
													<div class="bg-gray2 rounded-full p-2">

														<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
															xmlns="http://www.w3.org/2000/svg">
															<path
																d="M12 7C13.907 10.0531 16.7804 11.9966 20 11.9966C16.7804 11.9966 13.907 13.94 12 17"
																stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
															<path d="M20 12L4 12" stroke="#181B2B" stroke-width="1.5"
																stroke-miterlimit="10" />
														</svg>
													</div>
												</a>

											</li>
											<?php
										}
										?>
									</ul>
								</div>
							</div>
							<div class="bg-gray max-w-[19.75rem] w-full p-8">
								<?php
								$side_items = get_field( 'side_items', $item['ID'] );
								foreach ( $side_items as $item_group ) :
									?>
									<div class="mb-6">
										<?php foreach ( $item_group['item_group']['items'] as $side_item ) : ?>
											<a href=" <?php echo esc_url( $side_item['link']['url'] ); ?>"
												class="block mb-2 <?php echo $side_item['is_heading'] ? 'text-title-xs font-argent' : 'text-body-m-light'; ?>">
												<?php echo esc_html( $side_item['link']['title'] ); ?>
											</a>

										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</li>
			<?php
			$menu .= '<li class="py-5 border-b border-b-transparent ' . ( $header_type === 'light' ? 'text-black hover:border-b-black' : 'text-white hover:border-b-white' ) . '"><a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['title'] ) . '</a></li>';
	}

	?>
	</ul>
	<div class="flex items-center gap-2">
		<div class="py-3 px-5">

			<a href="#"
				class="erd_ghost text-caption font-semibold <?php echo $header_type === 'light' ? 'text-black' : 'text-white' ?>">
				<?php esc_html_e( 'Pildyti prašymą', 'erd' ); ?>
			</a>
		</div>
		<button class="erd_button text-caption font-semibold" @click="registerModalOpen = true">
			<?php esc_html_e( 'Registruotis apsilankymui', 'erd' ); ?>
		</button>
	</div>
</nav><!-- #site-navigation -->