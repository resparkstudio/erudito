<?php
/**
 * Careers list Block
 *
 * @package erudito
 */

$heading = get_field( 'heading' );
$bottom  = get_field( 'bottom' );

$careers = get_posts( args: array(
	'post_type' => 'career',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC',
) );

$cities = get_terms( args: array(
	'taxonomy' => 'city',
	'hide_empty' => false,
) );

if ( ! function_exists( 'empty_careers' ) ) {
	function empty_careers() {
		?>
		<div class="flex flex-col items-center max-w-[32.5rem] mx-auto">
			<svg class="w-[4.5rem] lg:w-[5.5rem] aspect-square mb-4 lg:mb-6" width="73" height="72" viewBox="0 0 73 72"
				fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect x="9.5" y="44.4653" width="24.5455" height="24.5455" transform="rotate(-20.175 9.5 44.4653)"
					fill="#CED7E1" />
				<circle cx="32.4096" cy="31.9091" r="20.4545" stroke="#181B2B" />
				<path d="M47.5449 46.6362L61.454 60.5453" stroke="#181B2B" />
			</svg>
			<p class="text-title-l-mobile lg:text-title-s mb-[0.3125rem] text-center font-argent">
				<?php esc_html_e( 'Šiuo metu neturime laisvų pozicijų', 'erd' ); ?>
			</p>
			<p class="text-body-m-light text-center">
				<?php esc_html_e( 'Pabandykite patikrinti šį puslapį vėliau: „Erudito“ komanda nuolat auga!', 'erd' ); ?>
			</p>
		</div>

		<?php
	}
}

?>

<div class="pb-12 lg:pb-20" x-data="{openTab: 0}">
	<div class="px-5 lg:px-20 pt-12 lg:pt-26 bg-gray">
		<div class="max-w-[32.625rem] lg:mb-16">
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
		</div>
		<div class="w-full flex">
			<?php foreach ( $cities as $index => $city ) : ?>
				<?php erd_tab( $index, $city->name ); ?>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="px-5 lg:px-20 pt-12 lg:pt-20">
		<div class="flex flex-col gap-8">
			<?php foreach ( $cities as $index => $city ) :
				$city_careers     = get_posts( args: array(
					'post_type' => 'career',
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'tax_query' => array(
						array(
							'taxonomy' => 'city',
							'field' => 'term_id',
							'terms' => $city->term_id,
						),
					),
				) );
				$city_has_careers = ! empty( $city_careers );


				?>
				<ul x-show="openTab === <?php echo esc_html( $index ); ?>" x-cloak>
					<?php
					if ( ! $city_has_careers ) {
						empty_careers();
					}
					?>
					<?php foreach ( $careers as $career ) : ?>
						<?php if ( has_term( $city->term_id, 'city', $career->ID ) ) : ?>
							<li class="py-5 lg:py-8 border-y border-y-gray3 first:border-t border-t-transparent first:pt-0">
								<a href="<?php echo esc_url( get_permalink( $career->ID ) ); ?>"
									class="flex items-center gap-4 w-full justify-between">
									<div>
										<p class="text-body-m lg:text-title-xs font-argent mb-2">
											<?php echo esc_html( $career->post_title ); ?>
										</p>
										<p class="text-caption">
											<?php $active_until = get_field( 'active_until', $career->ID ); ?>
											<?php esc_html_e( 'Galioja iki ' ) ?>
											<?php if ( $active_until ) : ?>
												<?php echo esc_html( date_i18n( 'Y-m-d', strtotime( $active_until ) ) ); ?>
											<?php endif; ?>
										</p>
									</div>
									<div class="bg-gray2 rounded-full p-2">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M12 7C13.907 10.0531 16.7804 11.9966 20 11.9966C16.7804 11.9966 13.907 13.94 12 17"
												stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
											<path d="M20 12L4 12" stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" />
										</svg>
									</div>
								</a>

							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="px-5 lg:px-20">

		<?php if ( $bottom ) : ?>
			<div class="pt-12 lg:pt-26 flex flex-col items-center max-w-[32.5rem] mx-auto">
				<?php if ( $bottom['icon'] ) : ?>
					<img src="<?php echo esc_url( $bottom['icon']['url'] ); ?>"
						alt="<?php echo esc_attr( $bottom['icon']['alt'] ); ?>"
						class="w-[4.5rem] lg:w-[5.5rem] aspect-square mb-4 lg:mb-6" />
				<?php endif; ?>
				<?php if ( $bottom['heading'] ) : ?>
					<h2 class="text-title-l-mobile lg:text-title-s mb-[0.3125rem] text-center">
						<?php echo esc_html( $bottom['heading'] ); ?>
					</h2>
				<?php endif; ?>
				<?php if ( $bottom['description'] ) : ?>
					<p class="text-body-m-light mb-6 lg:mb-8 text-center">
						<?php echo esc_html( $bottom['description'] ); ?>
					</p>
				<?php endif; ?>
				<?php if ( $bottom['button'] ) : ?>
					<div class="justify-center">
						<a href="<?php echo esc_url( $bottom['button']['url'] ); ?>" class="erd_button">
							<?php echo esc_html( $bottom['button']['title'] ); ?>
						</a>
					</div>
				<?php endif; ?>

			</div>
		<?php endif; ?>
	</div>
</div>