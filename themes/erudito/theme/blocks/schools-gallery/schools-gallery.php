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
		<div class="flex lg:gap-20 lg:pb-26 border-b border-gray3">
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
			</div>

		<?php endforeach; ?>
	</div>
</div>