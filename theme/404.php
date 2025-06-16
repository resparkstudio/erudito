<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package erudito
 */

get_header();
?>

<section id="primary" class="bg-blue relative h-screen">
	<main id="main" class="px-5 h-full">
		<div class="h-full items-center text-center text-white px-4 flex flex-col justify-center gap-4 md:gap-6 text-body-m-light">
			<h1 class="text-title-l-mobile md:text-title-xl"><?php esc_html_e('Error 404', 'erudito') ?></h1>
			<?php esc_html_e('The page you are looking for does not exist or has been deleted.', 'erudito'); ?>
			<a href="<?php echo get_home_url(); ?>" class="erd_button mt-2"><?php esc_html_e('Return home', 'erudito'); ?></a>
		</div>
	</main><!-- #main -->
	<div class="md:hidden">
		<svg width="186" height="366" class="absolute top-0 right-0" viewBox="0 0 186 366" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect x="129.75" y="76" width="111.601" height="111.601" transform="rotate(64.5239 129.75 76)" fill="#6A69B4" />
			<path fill-rule="evenodd" clip-rule="evenodd" d="M94.3832 -3.65763C51.4921 41.1605 53.0543 112.263 97.8724 155.154C110.969 167.687 126.309 176.425 142.535 181.396L102.6 254.661L284.195 353.645L383.18 172.049L279.853 115.728C296.351 74.4377 287.29 25.4821 253.195 -7.14684C208.377 -50.0379 137.274 -48.4758 94.3832 -3.65763Z" fill="#191F47" />
		</svg>
		<svg width="290" height="267" class="absolute bottom-0 left-0" viewBox="0 0 290 267" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M169.304 120.242C184.241 149.647 172.786 185.453 143.719 200.217C114.652 214.982 78.9808 203.114 64.0446 173.709C49.1083 144.305 60.5632 108.498 89.6299 93.7336C118.697 78.969 154.368 90.8371 169.304 120.242Z" fill="#6A69B4" />
			<rect x="-155.625" y="298.376" width="276.234" height="276.234" transform="rotate(-57.8987 -155.625 298.376)" fill="#191F47" />
		</svg>
	</div>
	<div class="hidden md:block">
		<svg class="absolute left-0 w-[25%] top-1/2 -translate-y-1/2" viewBox="0 0 304 513" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M242 426C242 474.049 203.496 513 156 513C108.504 513 70 474.049 70 426C70 377.951 108.504 339 156 339C203.496 339 242 377.951 242 426Z" fill="#F0CB69" />
			<rect x="-182" y="183.091" width="354.22" height="354.22" transform="rotate(-30.9701 -182 183.091)" fill="#191F47" />
			<rect x="179.086" y="64.5151" width="93.0837" height="93.0837" transform="rotate(33.1107 179.086 64.5151)" fill="#6A69B4" />
		</svg>
		<svg class="absolute right-0 w-[25%] top-1/2 -translate-y-1/2" viewBox="0 0 361 516" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect x="302.797" y="0.183594" width="202.906" height="202.906" transform="rotate(41.4004 302.797 0.183594)" fill="#F0CB69" />
			<path fill-rule="evenodd" clip-rule="evenodd" d="M22.0933 125.597C-17.8376 201.207 11.0862 294.872 86.6964 334.803C108.716 346.432 132.268 352.221 155.577 352.718L137.326 433.759L385.835 489.725L441.801 241.216L313.195 212.253C318.798 151.8 288.329 91.1122 231.299 60.9939C155.689 21.0629 62.0242 49.9868 22.0933 125.597Z" fill="#191F47" />
			<path d="M285 465.5C285 493.39 262.39 516 234.5 516C206.61 516 184 493.39 184 465.5C184 437.61 206.61 415 234.5 415C262.39 415 285 437.61 285 465.5Z" fill="#6A69B4" />
		</svg>

	</div>


</section><!-- #primary -->

<?php

get_footer();
