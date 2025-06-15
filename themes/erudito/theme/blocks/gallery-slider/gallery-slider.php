<?php
/**
 * Gallery Slider Block
 *
 * @package erudito
 */

$heading          = get_field( 'heading' );
$description      = get_field( 'description' );
$button           = get_field( 'button' );
$gallery          = get_field( 'gallery' );
$alignment        = get_field( 'alignment' );
$background_color = get_field( 'background_color' );

if ( ! $alignment ) {
	$alignment = 'left';
}
?>

<div class="pt-12 lg:pt-26 pb-8 lg:pb-20" style="background-color: <?php echo esc_attr( $background_color ); ?>;">
	<div class="px-5 lg:px-20 mb-8 lg:mb-12">
		<div class="<?php echo $alignment === 'left' ? '' : 'lg:text-center lg:mx-auto max-w-[32.625rem]' ?>">
			<?php erd_section_text( $heading, $description, $button ); ?>
		</div>
	</div>
	<?php if ( $gallery ) : ?>
		<div class="swiper gallery-slider">
			<div class="swiper-wrapper">
				<?php foreach ( $gallery as $image ) : ?>
					<div class="swiper-slide w-auto">
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"
							class="w-[15rem] lg:w-[31.25rem] aspect-square object-cover" />
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</div>