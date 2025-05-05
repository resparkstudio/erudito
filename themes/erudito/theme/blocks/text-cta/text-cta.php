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

if ( ! $heading && ! $description && ! $button && ! $link ) {
	return;
}

?>

<div class="bg-blue py-[6.25rem] lg:py-16 px-5 lg:px-20 text-white lg:min-h-[37.5rem]">
	<div class="max-w-[46.125rem] text-center h-full flex flex-col justify-center lg:text-left">
		<div>
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<p class="text-body-m-light mb-8">
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