<?php
/**
 * Closest Camps Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$camps       = get_field( 'camps' );

if ( ! $camps ) {
	$camps = get_posts( args: array(
		'post_type' => 'camp',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
	) );
}
?>
<div class="px-5 lg:px-20 pb-16 pt-12 lg:py-26">
	<div class="text-center pb-12 lg:pb-20 max-w-[32.5rem] mx-auto">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="text-body-m-light">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
	</div>
	<div class="flex flex-col gap-12">
		<?php if ( $camps ) : ?>
			<?php foreach ( $camps as $camp ) :
				$children_amount = get_field( 'children_amount', $camp->ID );
				$date            = get_field( 'date', $camp->ID );
				$location        = get_field( 'location', $camp->ID );
				$categories      = get_field( 'categories', $camp->ID );
				$register_until  = get_field( 'register_until', $camp->ID );
				$featured_image  = get_the_post_thumbnail_url( $camp->ID, 'full' );
				$camp_link       = get_permalink( $camp->ID );
				$camp_excerpt    = get_the_excerpt( $camp->ID );
				$camp_title      = get_the_title( $camp->ID );
				?>
				<div class="flex flex-col lg:flex-row w-full justify-between lg:border-t border-y-gray3 lg:py-20">
					<div class="w-full">
						<?php if ( $featured_image ) : ?>
							<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( $camp_title ); ?>"
								class="w-full aspect-[353/235] lg:aspect-square max-w-[40rem] object-cover mb-6 lg:mb-0" />
						<?php endif; ?>
					</div>
					<div class="max-w-[35rem] w-full flex flex-col justify-between">
						<div>
							<div
								class="bg-blue py-1 lg:py-[0.3125rem] px-1.5 lg:px-2 text-white w-max text-label-s lg:text-label-m mb-7 lg:mb-9">
								<?php echo esc_html( $register_until ); ?>
							</div>
							<h3 class="text-title-m-mobile lg:text-title-l mb-2 lg:mb-6">
								<a href="<?php echo esc_url( $camp_link ); ?>">
									<?php echo esc_html( $camp_title ); ?>
								</a>
							</h3>
							<p class="text-body-m-light mb-6 lg:mb-8">
								<?php echo esc_html( $camp_excerpt ); ?>
							</p>
							<ul class="flex flex-col gap-4 mb-6 lg:mb-0">
								<?php if ( $children_amount ) : ?>
									<li class="font-medium flex items-center gap-3">
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
									<li class="font-medium flex items-center gap-3">
										<svg class="shrink-0" width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M7 3.25V5.75" stroke="#181B2B" stroke-linecap="square"
												stroke-linejoin="round" />
											<path d="M13 3.25V5.75" stroke="#181B2B" stroke-linecap="square"
												stroke-linejoin="round" />
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
									<li class="font-medium flex items-center gap-3">
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
								<?php if ( $categories ) : ?>
									<li class="font-medium flex items-start gap-3">
										<svg class="shrink-0" width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M2.28906 12.1428L3.4319 13.2857L5.71758 11" stroke="#181B2B"
												stroke-linecap="square" />
											<path d="M2.28906 7.14284L3.4319 8.28568L5.71758 6" stroke="#181B2B"
												stroke-linecap="square" />
											<path d="M10 7H18" stroke="#181B2B" stroke-linecap="square" />
											<path d="M10 12H18" stroke="#181B2B" stroke-linecap="square" />
										</svg>
										<span>
											<?php echo esc_html( $categories ); ?>
										</span>
									</li>
								<?php endif; ?>
							</ul>
						</div>
						<div class="flex items-center gap-6">
							<a href="#" class="erd_button">
								<?php esc_html_e( 'Registruotis į stovyklą', 'erd' ); ?>
							</a>
							<a href="<?php echo esc_url( $camp_link ) ?>" class="font-semibold">
								<?php esc_html_e( 'Plačiau', 'erd' ); ?>
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="max-w-[32.5rem] mx-auto flex flex-col items-center text-center">
				<svg class="w-[4.5rem] h-[4.5rem] lg:w-[5.5rem] lg:h-[5.5rem]" width="88" height="88" viewBox="0 0 88 88"
					fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M52.5385 69.2173H7V20.2173H71V44.7173" stroke="#181B2B" stroke-width="1.5" />
					<path d="M7 32H71" stroke="#181B2B" stroke-width="1.5" />
					<path d="M19.543 15V24.7391" stroke="#181B2B" stroke-width="1.5" />
					<path d="M39.0195 15V24.7391" stroke="#181B2B" stroke-width="1.5" />
					<path d="M58.5 15V24.7391" stroke="#181B2B" stroke-width="1.5" />
					<circle cx="68" cy="62.2173" r="14" fill="#CED7E1" />
					<path d="M68 53V63.4348L73.5 66.5" stroke="#181B2B" stroke-width="1.5" />
				</svg>
				<h3 class="text-title-s mt-4 lg:mt-6 mb-2">
					<?php esc_html_e( 'Šiuo metu suplanuotų stovyklų nėra ', 'erd' ); ?>
				</h3>
				<p class="text-body-m-light">
					<?php esc_html_e( 'Nenusiminkite – mūsų stovyklos vyksta visus metus! Sekite naujienas ir netrukus sužinosite apie būsimus nuotykius.', 'erd' ); ?>
				</p>
			</div>
		<?php endif; ?>
	</div>
</div