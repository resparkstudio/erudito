<?php
/**
 * Container Block
 *
 * @package erudito
 */

$background_color = get_field( 'background_color' );
?>

<div class="w-full" style="background-color: <?php echo esc_attr( $background_color ); ?>;">
	<div class=" mx-auto text-white">
		<InnerBlocks />
	</div>
</div>