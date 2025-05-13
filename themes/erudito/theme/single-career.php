<?php
/**
 * The template for displaying single camp posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package erudito
 */

get_header();

$featured_image   = get_the_post_thumbnail_url();
$excerpt          = get_the_excerpt();
$title            = get_the_title();
$active_until     = get_field( 'active_until' );
$application_link = get_field( 'application_link' );
$city_taxonomy    = get_the_terms( get_the_ID(), 'city' );
$city             = $city_taxonomy ? $city_taxonomy[0]->name : '';
?>

<div class="px-5 lg:px-20 py-12 lg:py-26 w-full">
	<div class="flex flex-col lg:flex-row w-full justify-between lg:border-b border-b-gray3 lg:pb-16">
		<div class="max-w-[46.125rem] w-full flex flex-col justify-between">
			<div class="flex items-center gap-3 mb-2 lg:mb-4">
				<?php if ( isset( $city ) ) : ?>
					<span class="text-caption-semibold">
						<?php echo esc_html( $city ); ?>
					</span>
				<?php endif; ?>
				<span class="w-[4px] h-[4px] bg-violet rounded-full"></span>
				<?php if ( $active_until ) : ?>
					<p class="text-caption">
						<?php echo esc_html( date_i18n( 'Y-m-d', strtotime( $active_until ) ) ); ?>
					</p>
				<?php endif; ?>
			</div>
			<div>
				<h3 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
					<?php echo esc_html( $title ); ?>
				</h3>

			</div>
		</div>
		<div class="w-full max-w-[25.8125rem]">
			<?php if ( $featured_image ) : ?>
				<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( $title ); ?>"
					class="w-full aspect-[353/235] lg:aspect-[413/277] object-cover mb-6 lg:mb-0" />
			<?php endif; ?>
		</div>
	</div>
	<div class="flex flex-col lg:flex-row gap-8 w-full justify-between pt-16">
		<div class="max-w-[46rem] w-full">
			<?php the_content() ?>
		</div>
		<div class="max-w-[25.8125rem] w-full sticky top-4">

			<div class="w-full bg-gray h-max p-8 mb-1">
				<div>
					<img src="<?php echo get_template_directory_uri() . '/assets/schrole.png' ?>" alt=""
						class="mb-6 h-7">
					<h3 class="text-title-s mb-4">
						<?php esc_html_e( 'Aplikuoti per Schrole.com', 'erudito' ); ?>
					</h3>
					<p class="text-body-m-light mb-6 lg:mb-8">
						<?php echo esc_html_e( 'Užpildykite aplikacijos formą Schrole sistemoje. Paaiškinimas kodėl tai greita ir patogu.', 'erudito' ); ?>
					</p>
					<a href="<?php echo esc_url( $application_link['url'] ); ?>" class="erd_button">
						<?php echo esc_html( $application_link['title'] ); ?>
					</a>
				</div>
			</div>
			<div class="w-full bg-gray h-max p-8">
				<div>
					<h3 class="text-title-s mb-4">
						<?php esc_html_e( 'Aplikuoti el. paštu', 'erudito' ); ?>
					</h3>
					<p class="text-body-m-light mb-4">
						<?php echo esc_html_e( 'Atsiųskite gyvenimo aprašymą ir trumpą motyvacinį laišką el. paštu:', 'erudito' ); ?>
					</p>
					<a href="mailto:karjera@erudito.lt" class="underline font-medium">
						<?php esc_html_e( 'karjera@erudito.lt', 'erudito' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
?>