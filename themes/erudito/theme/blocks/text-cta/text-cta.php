<?php
/**
 * Text CTA Section Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$button      = get_field( 'button' );
$link        = get_field( 'link' );

$type = get_field( 'type' );

if ( ! $heading && ! $description && ! $button && ! $link ) {
	return;
}

if ( ! $type ) {
	$type = 'left';
}

?>

<div
	class="bg-blue py-[6.25rem]  px-5 lg:px-20 text-white <?php echo $type === 'left' ? 'lg:min-h-[37.5rem] lg:py-16' : 'lg:py-[8.625rem]' ?>">
	<div
		class="text-center h-full flex flex-col justify-between <?php echo $type === 'left' ? 'max-w-[46.125rem] lg:min-h-[37.5rem] lg:text-left' : 'items-center max-w-[46.125rem] mx-auto' ?>">
		<div>
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-xl mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<p class="text-body-m-light <?php echo $type === 'left' ? '' : 'mb-6 lg:mb-12' ?>">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
		</div>
		<div class="flex flex-col lg:flex-row gap-6 items-center">
			<?php if ( $button ) : ?>
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
					<?php echo esc_html( $button['title'] ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $link ) : ?>
				<a href="<?php echo esc_url( $link['url'] ); ?>" class="text-body-m font-semibold">
					<?php echo esc_html( $link['title'] ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>