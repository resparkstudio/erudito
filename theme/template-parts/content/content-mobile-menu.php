<?php

$header_type     = isset( $args['header_type'] ) ? $args['header_type'] : 'dark';
$top_bar_content = get_field( 'top_bar_content', 'option' );

$height_class = $top_bar_content ? 'h-[calc(100dvh-5.1875rem-3rem-1.5rem)]' : 'h-[calc(100dvh-5.1875rem-1.5rem)]';

?>

<div x-show="menuOpen" x-cloak
	class="absolute top-0 left-0 w-full z-10 <?php echo esc_attr( $height_class ); ?> bg-white" x-transition
	x-transition.duration.200ms>
	<div class="flex items-center justify-between border-b  w-full text-black border-gray3  px-5">
		<div class="flex items-center justify-center py-[0.9375rem] lg:py-[1.375rem] lg:px-[1.9375rem]">
			<?php if ( get_theme_mod( 'site_logo_dark' ) ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="">
					<img src="<?php echo esc_attr( get_theme_mod( 'site_logo_dark' ) ); ?>"
						alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="h-[2.875rem] aspect-[150/46]">
				</a>
			<?php else : ?>
				<a class="site-title"
					href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_url( bloginfo( 'name' ) ); ?></a>
			<?php endif; ?>
		</div>
		<div class="flex items-center justify-between gap-4 lg:hidden text-black">
			<a href="#" class="erd_button is-secondary py-2.5 px-5 text-caption-semibold ">
				<?php esc_html_e( 'Apsilankyti', 'erd' ); ?>
			</a>
			<button @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" type="button" class="flex  lg:hidden"
				aria-label="mobile menu" aria-controls="mobileMenu">
				<div class=" text-center  three col">
					<div id="hamburger-1">
						<span
							class="w-[1.25rem] h-[0.0625rem]  bg-black block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[3px] rotate-[45deg]' : ''"></span>
						<span
							class="w-[1.25rem] h-[0.0625rem]  bg-black block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[-3px] rotate-[-45deg]' : ''"></span>
					</div>
				</div>
			</button>
		</div>
	</div>
	<div class="bg-white pt-6 pb-5 h-full relative">
		<div class=" px-5">
			<?php get_search_form(); ?>
		</div>
		<div class="flex flex-col mt-6 gap-6">
			<?php
			$menu_locations = get_nav_menu_locations();
			$menu_id        = $menu_locations['menu-1'];

			$items = erd_menu_builder( $menu_id );
			foreach ( $items as $item ) {
				?>
				<div x-data="{ open: false }">
					<?php if ( $item['children'] ) : ?>
						<button class="flex items-center gap-1.5 text-black text-title-m-mobile font-argent  px-5"
							@click="open = !open">
							<?php echo esc_html( $item['title'] ); ?>
							<?php if ( $item['children'] ) : ?>
								<svg class="transition-all" x-bind:class="{'rotate-180': open}" width="16" height="16"
									viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M4 7L7.99968 9.5L12 7" stroke="#181B2B" stroke-miterlimit="10"
										stroke-linecap="square" />
								</svg>
							<?php endif; ?>
						</button>
					<?php else : ?>
						<a href="<?php echo esc_url( $item['url'] ); ?>"
							class="flex items-center gap-1.5 text-black text-title-m-mobile font-argent  px-5">
							<?php echo esc_html( $item['title'] ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $item['children'] ) : ?>
						<div class="flex flex-col mt-6 text-black bg-gray  px-5 py-8" x-show="open" x-transition>
							<?php foreach ( $item['children'] as $child ) : ?>
								<a href="<?php echo esc_url( $child['url'] ); ?>"
									class="flex items-center gap-4 w-full justify-between py-4 border-b border-b-gray3 first:pt-0 last:border-b-0">
									<div>
										<p class="text-body-m-medium mb-0.5">
											<?php echo esc_html( $child['title'] ); ?>
										</p>
										<p class="text-caption">
											<?php echo esc_html( get_field( 'description', $child['ID'] ) ); ?>
										</p>
									</div>
									<div class="bg-gray2 rounded-full p-[6px]">

										<svg width="20" height="20" viewBox="0 0 24 24" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M12 7C13.907 10.0531 16.7804 11.9966 20 11.9966C16.7804 11.9966 13.907 13.94 12 17"
												stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
											<path d="M20 12L4 12" stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
										</svg>
									</div>
								</a>
							<?php endforeach; ?>
							<div>
								<a href="<?php echo esc_url( $item['url'] ) ?>" class="erd_button mt-6 w-full">
									<?php esc_html_e( 'Plačiau', 'erd' ); ?>
								</a>
								<div class="bg-gray  w-full mt-8">
									<?php
									$side_items = get_field( 'side_items', $item['ID'] );
									foreach ( $side_items as $item_group ) :
										?>
										<div class="mb-6 last:mb-0">
											<?php foreach ( $item_group['item_group']['items'] as $side_item ) : ?>
												<a href=" <?php echo esc_url( $side_item['link']['url'] ); ?>"
													class="block erd_ghost w-max mb-3 <?php echo $side_item['is_heading'] ? 'text-body-m-medium' : 'text-body-m-light'; ?>">
													<?php echo esc_html( $side_item['link']['title'] ); ?>
												</a>

											<?php endforeach; ?>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

				</div>
				<?php
			}
			?>
		</div>
		<div class="flex flex-col px-5 mt-8 gap-3">
			<?php erd_register_button( __( 'Registruotis apsilankymui', 'erd' ) ); ?>
			<button class="erd_button is-secondary">
				<?php esc_html_e( 'Pildyti prašymą', 'erd' ); ?>
			</button>
		</div>
		<div class="flex items-center gap-0.5 px-5 mt-6">
			<?php $locale = apply_filters( 'locale', get_locale() ); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				class="erd_ghost text-caption font-semibold px-0.5 py-[0.3125rem] <?php echo $locale === 'lt_LT' ? 'text-black' : 'text-[#626A98]' ?>">
				LT
			</a>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				class="erd_ghost text-caption font-semibold px-0.5 py-[0.3125rem] <?php echo $locale === 'en_US' ? 'text-black' : 'text-[#626A98]' ?>">
				EN
			</a>
		</div>
		<div class="absolute px-5 text-black flex items-center text-caption bottom-5">
			<span class="border-r border-black pr-3">
				<?php esc_html_e( 'Vilnius and Kaunas', 'erd' ); ?>
			</span>
			<a href="tel:+37065788820" class="border-r px-3 border-black underline font-medium">
				<?php esc_html_e( '+370 657 888 20', 'erd' ); ?>
			</a>
			<a href="mailto:info@erudito.lt" class="pl-3 underline font-medium">
				<?php esc_html_e( 'info@erudito.lt', 'erd' ); ?>
			</a>
		</div>
	</div>
</div>