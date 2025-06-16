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
?>

<div class="px-5 lg:px-20 py-12 lg:py-26 w-full">
	<div class="flex flex-col lg:flex-row w-full items-end justify-between lg:border-b border-b-gray3 lg:pb-16">
		<div class="max-w-[46.125rem] w-full flex flex-col justify-between">
			<div>
				<div class="flex items-center gap-3 mb-2 lg:mb-8">
					<?php
					$categories = get_the_terms( $post->ID, 'category' );
					if ( $categories ) {
						foreach ( $categories as $category ) {
							if ( $category->slug !== 'featured' ) {
								echo '<span class="text-caption-semibold">' . esc_html( $category->name ) . '</span>';
							}
						}
					}
					?>
					<span class="w-[4px] h-[4px] bg-violet rounded-full"></span>
					<?php if ( $post->post_date ) : ?>
						<p class="text-caption">
							<?php echo esc_html( date_i18n( 'Y-m-d', strtotime( $post->post_date ) ) ); ?>
						</p>
					<?php endif; ?>
				</div>
				<h3 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
					<?php echo esc_html( $title ); ?>
				</h3>
				<p class="text-body-m-light mb-8 lg:mb-0">
					<?php echo esc_html( $excerpt ); ?>
				</p>
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
				<?php esc_html_e( 'Prisijunkite prie mūsų', 'erd' ); ?>
			</h3>
			<p class="text-body-m-light mb-6 lg:mb-8">
				<?php echo esc_html_e( 'Užsiregistruokite apsilankymui mokykloje ir taptikte mūsų bendruomenės dalimi!', 'erd' ); ?>
			</p>
			<?php erd_register_button(); ?>
		</div>
	</div>
</div>

<?php
get_footer();
?>