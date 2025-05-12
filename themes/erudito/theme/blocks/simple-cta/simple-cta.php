<?php
/**
 * Simple CTA Block
 *
 * @package erudito
 */

$top_text    = get_field( 'top_text' );
$heading     = get_field( 'heading' );
$description = get_field( 'description' );

?>

<div class="px-5 lg:px-20 pt-16 pb-12 lg:py-[12.25rem] bg-blue text-white lg:text-center">
	<?php if ( $top_text ) : ?>
		<p class="mb-8 font-normal">
			<?php echo esc_html( $top_text ); ?>
		</p>
	<?php endif; ?>
	<?php if ( $heading ) : ?>
		<h2
			class="max-w-[66.5625rem] mx-auto text-[1.5rem] leading-[1.75rem] lg:text-[3rem] lg:leading-[3.5rem] font-light mb-4 lg:mb-8">
			<?php echo esc_html( $heading ); ?>
		</h2>
	<?php endif; ?>
	<?php if ( $description ) : ?>
		<p class="max-w-[44.4375rem] mx-auto text-body-m-light">
			<?php echo esc_html( $description ); ?>
		</p>
	<?php endif; ?>
</div>