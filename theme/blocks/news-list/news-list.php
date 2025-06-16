<?php
/**
 * News List Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$news        = get_field( 'news' );

if ( ! $news ) {
	$news = get_posts( array(
		'post_type' => 'news',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
	) );
}
?>
<div class="px-5 lg:px-20 py-12 lg:py-26 bg-gray">
	<div class="mb-8 lg:mb-16 max-w-[39.375rem] mx-auto lg:text-center">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l mb-4">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="text-body-m-light">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
	</div>
	<div>
		<?php

		?>
		<?php if ( $news ) : ?>
			<div class="swiper news-slider">
				<div class="swiper-wrapper">
					<?php foreach ( $news as $news_item ) : ?>
						<div class="swiper-slide h-auto flex flex-col justify-between">
							<div>
								<?php if ( has_post_thumbnail( $news_item->ID ) ) : ?>
									<img src="<?php echo esc_url( get_the_post_thumbnail_url( $news_item->ID ) ); ?>"
										alt="<?php echo esc_attr( get_the_title( $news_item->ID ) ); ?>"
										class="w-full h-auto mb-6 aspect-[384/262]" />
								<?php endif; ?>
								<div class="flex items-center gap-3 mb-2 lg:mb-4">
									<?php
									$category = get_the_terms( $news_item->ID, 'category' );
									if ( $category && ! is_wp_error( $category ) ) {
										$category_name = $category[0]->name;
										$category_link = get_term_link( $category[0] );
									}
									?>
									<?php if ( isset( $category_name ) && isset( $category_link ) ) : ?>
										<span class="text-caption-semibold">
											<?php echo esc_html( $category_name ); ?>
										</span>
									<?php endif; ?>
									<span class="w-[4px] h-[4px] bg-violet rounded-full"></span>
									<?php if ( $news_item->post_date ) : ?>
										<p class="text-caption">
											<?php echo esc_html( date_i18n( 'Y-m-d', strtotime( $news_item->post_date ) ) ); ?>
										</p>
									<?php endif; ?>
								</div>
								<a href="<?php echo get_the_permalink( $news_item->ID ) ?>"
									class="text-body-m lg:text-subtitle-s mb-4">
									<?php echo esc_html( get_the_title( $news_item->ID ) ); ?>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="mt-8 lg:mt-16 flex lg:justify-center">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="erd_button">
					<?php esc_html_e( 'Daugiau naujienų', 'erd' ); ?>
				</a>
			</div>
		<?php else : ?>
			<p class="text-body-m-light">No news found.</p>
		<?php endif; ?>
	</div>
</div>