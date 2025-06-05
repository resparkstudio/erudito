<?php
/**
 * Schools gallery Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );

$tabs = get_field( 'tabs' );

if ( ! function_exists( 'school_info' ) ) {
	function school_info( $info ) {
		?>
		<div class="flex gap-12 lg:gap-20 pb-12 lg:pb-26 border-b border-gray3">
			<div class="max-w-[40rem] w-full">
				<?php if ( $info['video_thumbnail'] ) : ?>
					<img src="<?php echo esc_url( $info['video_thumbnail']['url'] ); ?>"
						alt="<?php echo esc_attr( $info['video_thumbnail']['alt'] ); ?>" class="w-full h-auto">
				<?php endif; ?>
			</div>
			<div class="flex flex-col justify-between">
				<div>
					<?php if ( $info['heading'] ) : ?>
						<h3 class="text-title-m-mobile lg:text-title-l mb-2 lg:mb-6">
							<?php echo esc_html( $info['heading'] ); ?>
						</h3>
					<?php endif; ?>
					<?php if ( $info['description'] ) : ?>
						<p class="text-body-m-light">
							<?php echo esc_html( $info['description'] ); ?>
						</p>
					<?php endif; ?>
				</div>
				<div class="pt-8 border-t border-gray3">
					<?php if ( $info['bottom_heading'] ) : ?>
						<h4 class="text-title-s-mobile lg:text-title-s mb-2">
							<?php echo esc_html( $info['bottom_heading'] ); ?>
						</h4>
					<?php endif; ?>
					<?php if ( $info['bottom_description'] ) : ?>
						<p class="text-body-m-light mb-4 lg:mb-8">
							<?php echo esc_html( $info['bottom_description'] ); ?>
						</p>
					<?php endif; ?>
					<?php erd_register_button( __( 'Registruotis', 'erudito' ) ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'school_facilities' ) ) {
	function school_facilities( $facilities ) {
		?>
		<?php foreach ( $facilities as $facility ) : ?>
			<div class="flex flex-col items-center">
				<?php if ( ! empty( $facility['images'] ) ) : ?>
					<div class="swiper school-facilities-slider max-w-[37.5rem] w-full">
						<div class="swiper-wrapper">
							<?php foreach ( $facility['images'] as $image ) : ?>
								<div class="swiper-slide">
									<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"
										class="w-full h-auto object-cover" />
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				<?php endif; ?>
				<h4 class="text-title-s-mobile lg:text-title-m mt-6 lg:mt-10 mb-1 lg:mb-2">
					<?php echo esc_html( $facility['heading'] ); ?>
				</h4>
				<p>
					<?php echo esc_html( $facility['description'] ); ?>
				</p>
			</div>
		<?php endforeach; ?>
		</div>
		<?php
	}
}

?>


<div class="pb-12 lg:pb-20" x-data="{openTab: 0, paymentOpen: 0}">
	<div class="px-5 lg:px-20 pt-12 lg:pt-26 bg-gray">
		<div class="max-w-[32.625rem] lg:mb-16">
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="text-body-m-light mb-12 lg:mb-0">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
		</div>
		<div class="w-full flex">
			<?php foreach ( $tabs as $index => $tab ) : ?>
				<?php erd_tab( $index, $tab['city_name'] ); ?>
			<?php endforeach; ?>
		</div>
	</div>
	<div>
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<div class="px-5 lg:px-20 lg:pt-20" x-show="openTab === <?php echo $index; ?>">
				<?php if ( $tab['school_info'] ) : ?>
					<?php school_info( $tab['school_info'] ); ?>
				<?php endif; ?>

				<?php if ( $tab['school_facilities'] ) : ?>
					<div class="mt-12 lg:mt-26">
						<h3 class="text-title-m-mobile lg:text-title-l mb-8 lg:mb-20 text-center">
							<?php echo esc_html( $tab['facilities_heading'] ); ?>
						</h3>
						<div class="grid grid-cols-1 lg:grid-cols-2">
							<?php school_facilities( $tab['school_facilities'] ); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>