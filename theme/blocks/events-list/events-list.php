<?php
/**
 * Events List Block
 *
 * @package erudito
 */

$heading = get_field( 'heading' );
$button  = get_field( 'button' );

$events = get_field( 'events' );

if ( ! $events ) {
	$events = get_posts( args: array(
		'post_type' => 'event',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
	) );
}

if ( ! function_exists( 'events_slider' ) ) {
	function events_slider( $events ) {
		?>
		<div class="swiper events-slider">
			<div class="swiper-wrapper">
				<?php foreach ( $events as $event ) :
					$date  = get_field( 'date', $event->ID );
					$hours = get_field( 'hours', $event->ID );
					$bead  = get_field( 'bead', $event->ID );
					?>
					<div
						class="swiper-slide h-auto flex flex-col-reverse lg:flex-col justify-between lg:px-10 lg:border-l border-l-gray3">
						<a href="<?php echo get_the_permalink( $event->ID ) ?>" class="text-subtitle-s mt-4 lg:hidden ">
							<?php echo esc_html( get_the_title( $event->ID ) ); ?>
						</a>
						<div class="flex w-full justify-between mt-6 lg:mt-0 lg:mb-20">
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
							<h2 class="text-subtitle-s mb-4 hidden lg:block">
								<?php echo esc_html( get_the_title( $event->ID ) ); ?>
							</h2>
							<?php if ( has_post_thumbnail( $event->ID ) ) : ?>
								<img src="<?php echo esc_url( get_the_post_thumbnail_url( $event->ID ) ); ?>"
									alt="<?php echo esc_attr( get_the_title( $event->ID ) ); ?>"
									class="w-full h-auto aspect-[384/262]" />
							<?php endif; ?>
						</div>
					</div>

				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

}

if ( ! function_exists( 'events_grid' ) ) {
	function events_grid( $events ) {
		?>
		<div class="grid grid-cols-2 gap-10 grid-rows-1">
			<?php foreach ( $events as $event ) :
				$date  = get_field( 'date', $event->ID );
				$hours = get_field( 'hours', $event->ID );
				$bead  = get_field( 'bead', $event->ID );
				?>
				<div class="h-auto flex flex-col justify-between px-10 border-l border-l-gray3">
					<div class="flex w-full justify-between mb-20">
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
						<a href="<?php echo get_the_permalink( $event->ID ) ?>" class="text-subtitle-s mb-4 hidden lg:block">
							<?php echo esc_html( get_the_title( $event->ID ) ); ?>
						</a>
						<?php if ( has_post_thumbnail( $event->ID ) ) : ?>
							<img src="<?php echo esc_url( get_the_post_thumbnail_url( $event->ID ) ); ?>"
								alt="<?php echo esc_attr( get_the_title( $event->ID ) ); ?>" class="w-full h-auto aspect-[384/262]" />
						<?php endif; ?>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
		<?php
	}
}
?>
<div class="px-5 lg:px-20 py-12 lg:py-26 flex flex-col lg:flex-row gap-8 lg:gap-10">
	<div class="flex flex-col h-auto justify-between items-start  max-w-[25rem] w-full">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $button ) : ?>
			<div class="justify-center hidden lg:flex">
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
					<?php echo esc_html( $button['title'] ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
	<div>
		<?php if ( $events ) : ?>
			<div class="lg:hidden">
				<?php events_slider( $events ); ?>
			</div>
			<div class="hidden lg:block">
				<?php events_grid( $events ); ?>
			</div>
		<?php else : ?>
			<p class="text-body-m-light">No events found.</p>
		<?php endif; ?>
	</div>
	<?php if ( $button ) : ?>
		<div class="flex lg:hidden">
			<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
				<?php echo esc_html( $button['title'] ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>