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

<div class="px-5 lg:px-20 pt-12 lg:pt-26 pb-8 lg:pb-20"
	style="background-color: <?php echo esc_attr( $background_color ); ?>;">
	<div class="max-w-[31.25rem] mb-8 lg:mb-12 <?php echo $alignment === 'left' ? '' : 'lg:text-center lg:mx-auto' ?>">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="text-body-m-light mt-4 lg:mt-6">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
		<?php if ( $button ) : ?>
			<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button mt-6 lg:mt-8">
				<?php echo esc_html( $button['title'] ); ?>
			</a>
		<?php endif; ?>
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