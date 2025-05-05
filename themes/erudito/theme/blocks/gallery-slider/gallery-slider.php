<?php
/**
 * Gallery Slider Block
 *
 * @package erudito
 */

$heading = get_field( 'heading' );
$gallery = get_field( 'gallery' );

?>

<div class="px-5 lg:px-20 pt-12 lg:pt-26 pb-8 lg:pb-3">
	<?php if ( $heading ) : ?>
		<h2 class="text-title-l-mobile lg:text-title-l mb-8 lg:mb-12">
			<?php echo esc_html( $heading ); ?>
		</h2>
	<?php endif; ?>
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