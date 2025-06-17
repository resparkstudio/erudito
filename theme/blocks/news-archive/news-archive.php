<?php
/**
 * News Archive Block
 *
 * @package erudito
 */

$heading = get_field( 'heading' );

$news_categories = get_terms( array(
	'taxonomy' => 'category',
	'hide_empty' => true,
) );

$news_categories = array_filter( $news_categories, function ($category) {
	return ! in_array( $category->slug, array( 'uncategorized', 'featured' ), true );
} );


$selected_category = isset( $_GET['category'] ) ? sanitize_text_field( $_GET['category'] ) : 'all';



?>

<div class="px-5 lg:px-20">
	<div class="pt-12 lg:pt-26 pb-8 lg:pb-16 lg:border-b border-b-gray3">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-xl lg:text-center">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $news_categories ) : ?>
			<div class="swiper tab-slider !w-auto lg:flex flex-wrap gap-0.5 mt-8 lg:mt-12 justify-center">
				<div class="swiper-wrapper !w-auto">
					<button value="all"
						class="news-filter-button swiper-slide w-max px-4 lg:px-5 py-[0.625rem] hover:text-black rounded-full font-medium text-gray4 cursor-pointer transition-all duration-300 ease-in-out <?php echo $selected_category === 'all' ? 'bg-gray !text-black' : ''; ?>">
						<?php esc_html_e( 'Visos kategorijos', 'erd' ) ?>
					</button>
					<?php foreach ( $news_categories as $category ) : ?>
						<button value="<?php echo esc_attr( $category->slug ); ?>"
							class="news-filter-button swiper-slide w-max px-4 lg:px-5 py-[0.625rem] hover:text-black rounded-full font-medium text-gray4 cursor-pointer transition-all duration-200 ease-in-out <?php echo $selected_category === $category->slug ? 'bg-gray !text-black' : ''; ?>">
							<?php echo esc_html( $category->name ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="pb-12 lg:pb-26 news-archive">
		<?php get_template_part( 'template-parts/content/content-news' ); ?>
	</div>
</div>