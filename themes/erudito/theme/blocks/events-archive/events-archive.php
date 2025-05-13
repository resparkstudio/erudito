<?php
/**
 * Events Archive Block
 *
 * @package erudito
 */


$heading = get_field( 'heading' );

$events = get_posts( array(
	'post_type' => 'event',
	'posts_per_page' => 3,
	'orderby' => 'date',
	'order' => 'DESC',
) );




if ( ! function_exists( 'large_event_card' ) ) {
	function large_event_card( $post ) {
		$thumbnail = get_the_post_thumbnail_url( $post->ID );
		$date      = get_field( 'date', $post->ID );
		$hours     = get_field( 'hours', $post->ID );
		$bead      = get_field( 'bead', $post->ID );
		?>
		<div class="w-full flex flex-col lg:flex-row lg:py-14 lg:border-b border-b-gray3 gap-6 lg:gap-16">
			<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="max-w-[40rem] w-full">
				<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>"
					class="aspect-[640/436] max-w-[40rem] w-full" />
			</a>

			<div class="flex flex-col justify-between">
				<div class="flex w-full justify-between mb-4 lg:mb-0">
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
					<?php if ( $bead ) : ?>
						<div class="text-label-s text-white bg-blue px-1.5 py-1 h-min">
							<?php echo esc_html( $bead ); ?>
						</div>
					<?php endif; ?>
				</div>
				<div>
					<h2 class="text-body-m lg:text-title-l lg:mb-8 font-public lg:font-argent">
						<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
							<?php echo esc_html( get_the_title( $post->ID ) ); ?>
						</a>
					</h2>
					<p class="hidden lg:block text-body-m-light mb-8">
						<?php echo esc_html( get_the_excerpt( $post->ID ) ); ?>
					</p>
					<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="erd_button hidden lg:inline-block">
						<?php esc_html_e( 'Skaityti plačiau', 'erd' ); ?>
					</a>
				</div>
			</div>
		</div>
		<?php
	}
}

?>

<div class="px-5 lg:px-20">
	<div class="pt-12 lg:pt-26 pb-8 lg:pb-16 lg:border-b border-b-gray3">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-xl lg:text-center">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<div class="flex flex-wrap gap-0.5 mt-8 lg:mt-12 justify-center">
			<div class="swiper-wrapper !w-auto">
				<button value="upcoming"
					class="swiper-slide w-max px-4 lg:px-5 py-[0.625rem] hover:bg-gray rounded-full font-medium text-gray4 cursor-pointer transition-all duration-300 ease-in-out">
					<?php esc_html_e( 'Artėjantys renginiai', 'erudito' ) ?>
				</button>
				<button value="past"
					class="swiper-slide w-max px-4 lg:px-5 py-[0.625rem] hover:bg-gray rounded-full font-medium text-gray4 cursor-pointer transition-all duration-300 ease-in-out">
					<?php esc_html_e( 'Praėję renginiai', 'erudito' ) ?>
				</button>
			</div>
		</div>
	</div>
	<div class="pb-12 lg:pb-26">
		<?php if ( $events ) : ?>
			<?php
			$latest_post = array_shift( $events );
			$rest_posts  = array_slice( $events, 0, 2 );
			large_event_card( $latest_post ); ?>
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-16 pt-10 lg:pt-14">
				<?php foreach ( $rest_posts as $post ) :
					$date  = get_field( 'date', $post->ID );
					$hours = get_field( 'hours', $post->ID );
					$bead  = get_field( 'bead', $post->ID );
					?>
					<div class="w-full flex flex-col">
						<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class=" w-full block mb-6">
							<img src="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID ) ); ?>"
								alt="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>" class="aspect-[384/262]  w-full" />
						</a>
						<div>
							<div class="flex w-full justify-between mb-4 lg:mb-6">
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
								<?php if ( $bead ) : ?>
									<div class="text-label-s text-white bg-blue px-1.5 py-1 h-min">
										<?php echo esc_html( $bead ); ?>
									</div>
								<?php endif; ?>
							</div>
							<h2 class="text-body-m lg:text-title-xs font-normal font-public">
								<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
									<?php echo esc_html( get_the_title( $post->ID ) ); ?>
								</a>
							</h2>

						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>