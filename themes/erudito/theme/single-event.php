<?php
/**
 * The template for displaying single camp posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package erudito
 */

get_header();

$featured_image = get_the_post_thumbnail_url();
$excerpt        = get_the_excerpt();
$title          = get_the_title();
$date           = get_field( 'date' );
$hours          = get_field( 'hours' );
$bead           = get_field( 'bead' );
?>

<div class="px-5 lg:px-20 py-12 lg:py-26 w-full">
	<div class="flex flex-col lg:flex-row w-full justify-between lg:border-b border-b-gray3 lg:pb-16">
		<div class="max-w-[46.125rem] w-full flex flex-col justify-between">
			<div class="flex w-full justify-between">
				<?php if ( $bead ) : ?>
					<div class="text-label-s text-white bg-blue px-1.5 py-1 h-min">
						<?php echo esc_html( $bead ); ?>
					</div>
				<?php endif; ?>
			</div>
			<div>
				<h3 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
					<?php echo esc_html( $title ); ?>
				</h3>
				<div>
					<?php if ( $date ) : ?>
						<div class="flex items-center gap-3">
							<span class="w-[12px] h-[12px] bg-violet"></span>
							<p class="text-caption-semibold">
								<?php echo esc_html( $date ); ?>
							</p>
						</div>
					<?php endif; ?>
					<?php if ( $hours ) : ?>
						<div class="flex items-center gap-3">
							<span class="w-[14px] h-[14px] bg-yellow rounded-full"></span>
							<p class="text-caption">
								<?php echo esc_html( $hours ); ?>
							</p>
						</div>
					<?php endif; ?>
				</div>
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
		<div class="max-w-[25.8125rem] w-full bg-gray h-max p-8 sticky top-4">
			<h3 class="text-title-s mb-4">
				<?php esc_html_e( 'Nepamirškite užsiregistruoti!', 'erudito' ); ?>
			</h3>
			<p class="text-body-m-light mb-6 lg:mb-8">
				<?php echo esc_html_e( 'Registracija vyksta iki gruodžio 1d.', 'erudito' ); ?>
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