<?php
/**
 * Template part for displaying news content
 *
 * @package erudito
 */

$args = isset( $args['news'] ) ? $args['news'] : array(
	'post_type' => 'news',
	'posts_per_page' => 3,
	'orderby' => 'date',
	'order' => 'DESC',
);

$news_query = new WP_Query( query: $args );

if ( ! function_exists( 'large_news_card' ) ) {
	function large_news_card( $post_id ) {
		$thumbnail = get_the_post_thumbnail_url( $post_id );
		?>
		<div class="w-full flex flex-col lg:flex-row lg:py-14 lg:border-b border-b-gray3 gap-6 lg:gap-16">
			<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="max-w-[40rem] w-full">
				<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"
					class="aspect-[640/436] max-w-[40rem] w-full" />
			</a>

			<div class="flex flex-col justify-between">
				<div class="flex items-center gap-3 mb-2 lg:mb-0">
					<?php
					$categories = get_the_terms( $post_id, 'category' );
					if ( $categories ) {
						foreach ( $categories as $category ) {
							if ( $category->slug !== 'featured' ) {
								echo '<span class="text-caption-semibold">' . esc_html( $category->name ) . '</span>';
							}
						}
					}
					?>
					<span class="w-[4px] h-[4px] bg-violet rounded-full"></span>
					<?php if ( get_post_field( 'post_date', $post_id ) ) : ?>
						<p class="text-caption">
							<?php echo esc_html( date_i18n( 'Y-m-d', strtotime( get_post_field( 'post_date', $post_id ) ) ) ); ?>
						</p>
					<?php endif; ?>
				</div>
				<div>
					<h2 class="text-body-m lg:text-title-l lg:mb-8 font-public lg:font-argent">
						<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
							<?php echo esc_html( get_the_title( $post_id ) ); ?>
						</a>
					</h2>
					<p class="hidden lg:block text-body-m-light mb-8">
						<?php echo esc_html( get_the_excerpt( $post_id ) ); ?>
					</p>
					<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="erd_button hidden lg:inline-block">
						<?php esc_html_e( 'Skaityti plačiau', 'erd' ); ?>
					</a>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( $news_query->have_posts() ) :
	$counter = 0;
	?>
	<?php while ( $news_query->have_posts() ) :
		$news_query->the_post(); ?>
		<?php if ( $counter === 0 ) : ?>
			<?php large_news_card( get_the_ID() ); ?>
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-16 pt-10 lg:pt-14">
			<?php else : ?>
				<div class="w-full flex flex-col">
					<a href="<?php the_permalink(); ?>" class=" w-full block mb-6">
						<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>"
							alt="<?php echo esc_attr( get_the_title() ); ?>" class="aspect-[384/262] w-full" />
					</a>
					<div>
						<div class="flex items-center gap-3 mb-2 lg:mb-4">
							<?php
							$category = get_the_terms( get_the_ID(), 'category' );
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
							<?php if ( get_post_field( 'post_date', get_the_ID() ) ) : ?>
								<p class="text-caption">
									<?php echo esc_html( date_i18n( 'Y-m-d', strtotime( get_post_field( 'post_date', get_the_ID() ) ) ) ); ?>
								</p>
							<?php endif; ?>
						</div>
						<h2 class="text-body-m lg:text-title-xs font-normal font-public">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
					</div>
				</div>
			<?php endif; ?>
			<?php $counter++; ?>
		<?php endwhile; ?>
	</div>
	<?php
	wp_reset_postdata();
endif;
?>