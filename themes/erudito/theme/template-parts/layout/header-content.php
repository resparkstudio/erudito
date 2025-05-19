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

if ( ! function_exists( 'erd_search' ) ) {
	function erd_search() {
		?>
		<div x-show="searchOpen" x-cloak class="absolute top-full left-0 w-full px-10 z-10" x-transition
			x-transition.duration.200ms>
			<div class="bg-white p-8">
				<?php get_search_form(); ?>
			</div>
		</div>
		<?php
	}
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
				<?php esc_html_e( 'Apsilankyti', 'erd' ); ?>
			</a>
			<button @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" type="button" class="flex  lg:hidden"
				aria-label="mobile menu" aria-controls="mobileMenu">
				<div class=" text-center  three col">
					<div id="hamburger-1">
						<span
							class="w-[1.25rem] h-[0.0625rem]  bg-white block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[3px] rotate-[45deg]' : ''"></span>
						<span
							class="w-[1.25rem] h-[0.0625rem]  bg-white block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[-3px] rotate-[-45deg]' : ''"></span>
					</div>
				</div>
			</button>
			<?php get_template_part( 'template-parts/content/content', 'mobile-menu' ); ?>
		</div>
		<div x-data="{searchOpen: false}"
			class="w-full border-b  py-[0.625rem] px-6 hidden lg:flex justify-between <?php echo $header_type === 'light' ? 'text-black border-b-gray3' : 'text-white border-b-[#FFFFFF26]' ?>">
			<div>
				<span class="border-r borde-white text-caption pr-3">
					Vilniuje ir Kaune
				</span>
				<a href="tel:+37065788820"
					class="border-r  px-3 <?php echo $header_type === 'light' ? 'border-black' : 'border-white' ?>">
					+370 657 888 20
				</a>
				<a href="mailto:info@erudito.lt" class="pl-3">
					info@erudito.lt
				</a>
			</div>
			<div class="flex items-center gap-5">
				<div>
					<button class="cursor-pointer" @click="searchOpen = !searchOpen">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M11.4329 18.8659C15.538 18.8659 18.8659 15.538 18.8659 11.4329C18.8659 7.32784 15.538 4 11.4329 4C7.32784 4 4 7.32784 4 11.4329C4 15.538 7.32784 18.8659 11.4329 18.8659Z"
								stroke="<?php echo $header_type === 'light' ? '#181B2B' : 'white' ?>"
								stroke-linecap="round" stroke-linejoin="round" />
							<path d="M16.6875 16.689L19.9997 20.0012"
								stroke="<?php echo $header_type === 'light' ? '#181B2B' : 'white' ?>"
								stroke-linecap="square" stroke-linejoin="round" />
						</svg>
					</button>
					<?php erd_search(); ?>
				</div>

				<div class="flex items-center gap-0.5">
					<?php $locale = apply_filters( 'locale', get_locale() );
					?>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						class="erd_ghost text-label-m font-semibold px-0.5 py-[0.3125rem] <?php echo $locale === 'lt_LT' ? 'text-white' : 'text-[#626A98]' ?>">
						LT
					</a>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						class="erd_ghost text-label-m font-semibold px-0.5 py-[0.3125rem] <?php echo $locale === 'en_US' ? 'text-white' : 'text-[#626A98]' ?>">
						EN
					</a>
				</div>
			</div>
		</div>

		<?php get_template_part( 'template-parts/content/content', 'mega-menu-desktop', [ 
			'header_type' => $header_type,
		] ); ?>
	</div>

</header><!-- #masthead -->