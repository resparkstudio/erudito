<?php

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package erudito
 */


// Only hide header on checkout, but NOT on order-received page
if (is_checkout() && ! is_wc_endpoint_url('order-received')) {
	return;
}
$top_bar_content = get_field('top_bar_content', 'option');
$header_type     = get_field('header_type');

if (is_singular(post_types: 'product')) {
	$header_type = 'light';
} elseif (! $header_type) {
	$header_type = 'dark';
}

// Add support for 'white' header_type
$header_classes        = '';
$border_classes        = '';
$text_classes          = '';
$button_before_classes = '';
$search_icon_color     = '';
$border_b_classes      = '';

if ($header_type === 'light') {
	$header_classes        = 'bg-gray text-black border-gray3';
	$border_classes        = 'border-gray3';
	$text_classes          = 'text-black';
	$button_before_classes = 'before:bg-white';
	$search_icon_color     = '#181B2B';
	$border_b_classes      = 'text-black border-b-gray3';
} elseif ($header_type === 'white') {
	$header_classes        = 'bg-white text-black border-gray3';
	$border_classes        = 'border-gray3';
	$text_classes          = 'text-black';
	$button_before_classes = 'before:bg-gray3';
	$search_icon_color     = '#181B2B';
	$border_b_classes      = 'text-black border-b-gray3';
} else {
	$header_classes        = 'bg-blue border-[#FFFFFF26]';
	$border_classes        = 'border-[#FFFFFF26]';
	$text_classes          = 'text-white';
	$button_before_classes = 'before:bg-[#394173]';
	$search_icon_color     = 'white';
	$border_b_classes      = 'text-white border-b-[#FFFFFF26]';
}

if (! function_exists('erd_search')) {
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

<div class="fixed top-8 z-50 left-0 right-0 px-5 flex flex-col gap-1.5 items-center" data-notifications="container">
</div>
<?php if ($top_bar_content) : ?>
	<div class="bg-black text-white text-center text-label-m py-2 lg:py-[0.375rem]">
		<?php echo $top_bar_content ?>
	</div>
<?php endif; ?>
<header id="masthead" class="relative flex items-center justify-between border-b w-full <?php echo $header_classes; ?>">
	<div class="flex items-center justify-center py-[0.9375rem] px-5 lg:py-[1.375rem] lg:px-[1.9375rem]">
		<?php if (get_theme_mod('site_logo_light') && $header_type === 'dark') : ?>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="">
				<img src="<?php echo esc_attr(get_theme_mod('site_logo_light')); ?>"
					alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="lg:h-[2.875rem] aspect-[150/46]">
			</a>
		<?php elseif (get_theme_mod('site_logo_dark') && ($header_type === 'light' || $header_type === 'white')) : ?>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="">
				<img src="<?php echo esc_attr(get_theme_mod('site_logo_dark')); ?>"
					alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="lg:h-[2.875rem] aspect-[150/46]">
			</a>
		<?php else : ?>
			<a class="site-title"
				href="<?php echo esc_url(home_url('/')); ?>"><?php esc_url(bloginfo('name')); ?></a>
		<?php endif; ?>
	</div>

	<div class="lg:w-full lg:border-l pr-5 lg:pr-0 <?php echo $border_classes; ?>" x-data="{ menuOpen: false }">
		<div class="flex items-center justify-between gap-4 lg:hidden <?php echo $text_classes; ?>">
			<a href="#" class="erd_button py-2.5 px-5 text-caption-semibold <?php echo $button_before_classes; ?>">
				<?php esc_html_e('Apsilankyti', 'erudito'); ?>
			</a>
			<button @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" type="button" class="flex  lg:hidden"
				aria-label="mobile menu" aria-controls="mobileMenu">
				<div class=" text-center  three col">
					<div id="hamburger-1">
						<span
							class="w-[1.25rem] h-[0.0625rem] block my-[4px] mx-auto transition-all duration-300 ease-in-out <?php echo $header_type === 'dark' ? 'bg-white' : 'bg-blue' ?>"
							:class="menuOpen ? 'translate-y-[3px] rotate-[45deg]' : ''"></span>
						<span
							class="w-[1.25rem] h-[0.0625rem] block my-[4px] mx-auto transition-all duration-300 ease-in-out <?php echo $header_type === 'dark' ? 'bg-white' : 'bg-blue' ?>"
							:class="menuOpen ? 'translate-y-[-3px] rotate-[-45deg]' : ''"></span>
					</div>
				</div>
			</button>
			<?php get_template_part('template-parts/content/content', 'mobile-menu', ['header_type' => $header_type]); ?>
		</div>
		<div x-data="{searchOpen: false}"
			class="w-full border-b py-[0.625rem] px-6 hidden lg:flex justify-between <?php echo $border_b_classes; ?>">
			<div>
				<span class="border-r borde-white text-caption pr-3">
					Vilniuje ir Kaune
				</span>
				<a href="tel:+37065788820"
					class="border-r px-3 <?php echo $header_type === 'light' || $header_type === 'white' ? 'border-black' : 'border-white' ?>">
					+370 657 888 20
				</a>
				<a href="mailto:info@erudito.lt" class="pl-3">
					info@erudito.lt
				</a>
			</div>
			<div class="flex items-center gap-5">
				<div>
					<button class="cursor-pointer" @click="searchOpen = !searchOpen">
						<svg x-show="!searchOpen" width="24" height="24" viewBox="0 0 24 24" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path
								d="M11.4329 18.8659C15.538 18.8659 18.8659 15.538 18.8659 11.4329C18.8659 7.32784 15.538 4 11.4329 4C7.32784 4 4 7.32784 4 11.4329C4 15.538 7.32784 18.8659 11.4329 18.8659Z"
								stroke="<?php echo $search_icon_color; ?>" stroke-linecap="round"
								stroke-linejoin="round" />
							<path d="M16.6875 16.689L19.9997 20.0012" stroke="<?php echo $search_icon_color; ?>"
								stroke-linecap="square" stroke-linejoin="round" />
						</svg>
						<svg x-show="searchOpen" width="24" height="24" viewBox="0 0 24 24" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path d="M5 19L19 5" stroke="<?php echo $search_icon_color; ?>" stroke-miterlimit="10"
								stroke-linecap="square" />
							<path d="M19 19L5 5" stroke="<?php echo $search_icon_color; ?>" stroke-miterlimit="10"
								stroke-linecap="square" />
						</svg>
					</button>
					<?php erd_search(); ?>
				</div>

				<div class="flex items-center gap-0.5">
					<?php $locale             = apply_filters('locale', get_locale());
					$selected_classes   = 'text-white';
					$unselected_classes = 'text-[#626A98]';
					if ($header_type !== 'dark') {
						$selected_classes   = 'text-black';
						$unselected_classes = 'text-[#626A98]';
					}
					?>
					<a href="<?php echo esc_url(home_url('/')); ?>"
						class="erd_ghost text-label-m font-semibold px-0.5 py-[0.3125rem] <?php echo $locale === 'lt_LT' ? $selected_classes : $unselected_classes ?>">
						LT
					</a>
					<a href="<?php echo esc_url(home_url('/')); ?>"
						class="erd_ghost text-label-m font-semibold px-0.5 py-[0.3125rem] <?php echo $locale === 'en_US' ? $selected_classes : $unselected_classes ?>">
						EN
					</a>
				</div>
			</div>
		</div>

		<?php get_template_part('template-parts/content/content', 'mega-menu-desktop', [
			'header_type' => $header_type,
		]); ?>
	</div>

</header><!-- #masthead -->