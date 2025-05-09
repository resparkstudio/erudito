<?php
/**
 * The template for displaying single camp posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package erudito
 */

get_header();

$children_amount = get_field( 'children_amount' );
$date            = get_field( 'date' );
$location        = get_field( 'location' );
$categories      = get_field( 'categories' );
$register_until  = get_field( 'register_until' );
$featured_image  = get_the_post_thumbnail_url();
$camp_link       = get_permalink();
$camp_excerpt    = get_the_excerpt();
$camp_title      = get_the_title();
?>

<div class="px-5 lg:px-20 py-12 lg:py-26 w-full">
	<div class="flex flex-col lg:flex-row w-full justify-between lg:border-b border-b-gray3 lg:pb-16">
		<div class="max-w-[46.125rem] w-full flex flex-col justify-between">
			<div>
				<div
					class="bg-blue py-1 lg:py-[0.3125rem] px-1.5 lg:px-2 text-white w-max text-label-s lg:text-label-m mb-6 lg:mb-[1.875rem]">
					<?php echo esc_html( $register_until ); ?>
				</div>
				<h3 class="text-title-l-mobile lg:text-title-l mb-6 lg:mb-8">
					<?php echo esc_html( $camp_title ); ?>
				</h3>
				<ul class="flex flex-col gap-3 mb-8 lg:mb-0">
					<?php if ( $children_amount ) : ?>
						<li class="font-medium flex items-center gap-3 text-sm">
							<svg class="shrink-0" width="20" height="20" viewBox="0 0 20 20" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M10 9C11.3807 9 12.5 7.88071 12.5 6.5C12.5 5.11929 11.3807 4 10 4C8.61929 4 7.5 5.11929 7.5 6.5C7.5 7.88071 8.61929 9 10 9Z"
									stroke="#181B2B" stroke-linecap="round" stroke-linejoin="round" />
								<path
									d="M17.0764 16C15.7351 13.6211 13.0691 12 9.99916 12C6.92925 12 4.2632 13.6211 2.92188 16"
									stroke="#181B2B" />
							</svg>
							<span>
								<?php echo esc_html( $children_amount ); ?>
							</span>
						</li>
					<?php endif; ?>
					<?php if ( $date ) : ?>
						<li class="font-medium flex items-center gap-3 text-sm">
							<svg class="shrink-0" width="20" height="20" viewBox="0 0 20 20" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path d="M7 3.25V5.75" stroke="#181B2B" stroke-linecap="square" stroke-linejoin="round" />
								<path d="M13 3.25V5.75" stroke="#181B2B" stroke-linecap="square" stroke-linejoin="round" />
								<path d="M3.80469 8.42041H16.1969" stroke="#181B2B" stroke-linecap="square"
									stroke-linejoin="round" />
								<rect x="3.80469" y="4.55029" width="12.3922" height="11.6177" stroke="#181B2B" />
							</svg>
							<span>
								<?php echo esc_html( $date ); ?>
							</span>
						</li>
					<?php endif; ?>
					<?php if ( $location ) : ?>
						<li class="font-medium flex items-center gap-3 text-sm">
							<svg class="shrink-0" width="20" height="20" viewBox="0 0 20 20" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M10.0084 2.5C13.257 2.5 15.8918 5.13354 15.8918 8.38341C15.8918 13.8354 10.0084 17.5 10.0084 17.5C10.0084 17.5 4.125 13.8354 4.125 8.38341C4.125 5.13354 6.75854 2.5 10.0084 2.5Z"
									stroke="black" stroke-miterlimit="10" />
								<path
									d="M10.0096 10.3712C11.1669 10.3712 12.1051 9.43304 12.1051 8.27571C12.1051 7.11838 11.1669 6.18018 10.0096 6.18018C8.85226 6.18018 7.91406 7.11838 7.91406 8.27571C7.91406 9.43304 8.85226 10.3712 10.0096 10.3712Z"
									stroke="black" stroke-miterlimit="10" />
							</svg>
							<span>
								<?php echo esc_html( $location ); ?>
							</span>
						</li>
					<?php endif; ?>

				</ul>
			</div>
		</div>
		<div class="w-full max-w-[25.8125rem]">
			<?php if ( $featured_image ) : ?>
				<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( $camp_title ); ?>"
					class="w-full aspect-[353/235] lg:aspect-[413/277] object-cover mb-6 lg:mb-0" />
			<?php endif; ?>
		</div>
	</div>
	<div class="flex flex-col lg:flex-row gap-8 w-full justify-between pt-16">
		<div class="max-w-[46rem] w-full">
			<?php the_content() ?>
		</div>
		<div class="max-w-[25.8125rem] w-full bg-gray h-max p-8 sticky top-4">
			<h3 class="text-title-s mb-4">
				<?php esc_html_e( 'Išsankstinė registracija', 'erudito' ); ?>
			</h3>
			<p class="text-body-m-light mb-6 lg:mb-8">
				<?php echo esc_html_e( 'Užsiregistruokite iki gegužės 15 d.', 'erudito' ); ?>
			</p>
			<a href="#" class="erd_button">
				<?php esc_html_e( 'Registruotis', 'erudito' ); ?>
			</a>
		</div>
	</div>
</div>

<?php
get_footer();
?>