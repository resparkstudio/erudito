<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package erudito
 */

$top_bar_content = get_field( 'top_bar_content', 'option' );
$header_type     = get_field( 'header_type' );

if ( ! $header_type ) {
	$header_type = 'dark';
}
?>

<?php if ( $top_bar_content ) : ?>
	<div class="bg-black text-white text-center text-label-m py-2 lg:py-[0.375rem]">
		<?php echo $top_bar_content ?>
	</div>
<?php endif; ?>
<header id="masthead"
	class="relative flex items-center justify-between border-b  w-full <?php echo $header_type === 'light' ? 'bg-gray text-black border-gray3' : 'bg-blue border-[#FFFFFF26]' ?>">
	<div class="flex items-center justify-center py-[0.9375rem] px-5 lg:py-[1.375rem] lg:px-[1.9375rem]">
		<?php if ( get_theme_mod( 'site_logo_light' ) && $header_type === 'dark' ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="">
				<img src="<?php echo esc_attr( get_theme_mod( 'site_logo_light' ) ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="lg:h-[2.875rem] aspect-[150/46]">
			</a>
		<?php elseif ( get_theme_mod( 'site_logo_dark' ) && $header_type === 'light' ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="">
				<img src="<?php echo esc_attr( get_theme_mod( 'site_logo_dark' ) ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="lg:h-[2.875rem] aspect-[150/46]">
			</a>
		<?php else : ?>
			<a class="site-title"
				href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_url( bloginfo( 'name' ) ); ?></a>
		<?php endif; ?>
	</div>

	<div class="lg:w-full lg:border-l  pr-5 lg:pr-0 <?php echo $header_type === 'light' ? 'border-gray3' : 'border-[#FFFFFF26]' ?>"
		x-data="{ menuOpen: false }">
		<div
			class="flex items-center justify-between gap-4 lg:hidden <?php echo $header_type === 'light' ? 'text-black' : 'text-white' ?>">
			<a href="#"
				class="erd_button  py-2.5 px-5 text-caption-semibold <?php echo $header_type === 'light' ? 'before:bg-white' : 'before:bg-[#394173]' ?>">
				<?php esc_html_e( 'Apsilankyti', 'erudito' ); ?>
			</a>
			<button @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" type="button" class="flex  lg:hidden"
				aria-label="mobile menu" aria-controls="mobileMenu">
				<div class=" text-center  three col">
					<div id="hamburger-1">
						<span
							class="w-[1.25rem] h-[0.0625rem]  bg-white block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[6px] rotate-[45deg]' : ''"></span>
						<span
							class="w-[1.25rem] h-[0.0625rem]  bg-white block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[-6px] rotate-[-45deg]' : ''"></span>
					</div>
				</div>
			</button>

		</div>
		<div
			class="w-full border-b  py-[0.625rem] px-6 hidden lg:block <?php echo $header_type === 'light' ? 'text-black border-b-gray3' : 'text-white border-b-[#FFFFFF26]' ?>">
			<span class="border-r borde-white text-caption pr-3">
				Vilniuje ir Kaune
			</span>
			<a href="tel:+37065788820" class="border-r border-white px-3">
				+370 657 888 20
			</a>
			<a href="mailto:info@erudito.lt" class="pl-3">
				info@erudito.lt
			</a>
		</div>
		<nav id="site-navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'erudito' ); ?>"
			class="px-6 hidden lg:block">
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
										stroke="<?php echo $header_type === 'light' ? '#181B2B' : 'white' ?>"
										stroke-miterlimit="10" stroke-linecap="square" />
								</svg>
							<?php endif; ?>
						</a>
						<?php if ( $item['children'] ) : ?>
							<div x-show="open" class="absolute top-full left-0 w-full px-10 z-10" x-transition
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
												<?php esc_html_e( 'Plačiau', 'erudito' ); ?>
											</a>
										</div>
										<div class="w-full">
											<ul class="flex flex-col w-full">
												<?php
												foreach ( $item['children'] as $child ) {
													?>
													<li
														class=" py-5 border-y border-y-gray3 first:border-t border-t-transparent last:border-b-0">
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
																		stroke="#181B2B" stroke-width="1.5"
																		stroke-miterlimit="10" />
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
			</ul><?php


			?>
		</nav><!-- #site-navigation -->
	</div>

</header><!-- #masthead -->