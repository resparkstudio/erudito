<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package erudito
 */

?>

<header id="masthead" class="bg-blue flex items-center justify-between border-b border-[#FFFFFF26] w-full">

	<div class="flex items-center justify-center py-[0.9375rem] px-5 lg:py-[1.375rem] lg:px-[1.9375rem]">
		<?php if ( get_theme_mod( 'site_logo_light' ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="">
				<img src="<?php echo esc_attr( get_theme_mod( 'site_logo_light' ) ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="lg:h-[2.875rem] aspect-[150/46]">
			</a>
		<?php else : ?>
			<a class="site-title"
				href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_url( bloginfo( 'name' ) ); ?></a>
		<?php endif; ?>
	</div>

	<div class="lg:w-full lg:border-l border-[#FFFFFF26] pr-5 lg:pr-0" x-data="{ menuOpen: false }">
		<div class="flex items-center justify-between gap-4 lg:hidden">
			<a href="#" class="erd_button before:bg-[#394173] text-white py-2.5 px-5 text-caption-semibold">
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
		<div class="w-full border-b border-b-[#FFFFFF26] py-[0.625rem] px-6 hidden lg:block">
			<span class="text-white border-r borde-white text-caption pr-3">
				Vilniuje ir Kaune
			</span>
			<a href="tel:+37065788820" class="text-white border-r border-white px-3">
				+370 657 888 20
			</a>
			<a href="mailto:info@erudito.lt" class="text-white pl-3">
				info@erudito.lt
			</a>
		</div>
		<nav id="site-navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'erudito' ); ?>"
			class="px-6 hidden lg:block">
			<?php
			$menu_locations = get_nav_menu_locations();
			$menu_id        = $menu_locations['menu-1'];

			$items = erd_menu_builder( $menu_id );


			$menu = '<ul class="flex flex-col lg:flex-row gap-8">';
			foreach ( $items as $item ) {

				$menu .= '<li class="text-white py-5 hover:border-b-white border-b border-b-transparent"><a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['title'] ) . '</a></li>';
			}

			$menu .= '</ul>';

			echo $menu;

			?>
		</nav><!-- #site-navigation -->
	</div>

</header><!-- #masthead -->