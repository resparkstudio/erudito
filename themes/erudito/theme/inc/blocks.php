<?php
/**
 * Blocks
 **/

/**
 * Load Blocks
 */
function erd_load_blocks() {
	$blocks = erd_get_blocks();
	foreach ( $blocks as $block ) {
		if ( file_exists( get_stylesheet_directory() . '/blocks/' . $block . '/block.json' ) ) {
			register_block_type( get_stylesheet_directory() . '/blocks/' . $block . '/block.json' );
			if ( file_exists( get_stylesheet_directory() . '/blocks/' . $block . '/style.css' ) ) {
				wp_register_style( 'block-' . $block, get_stylesheet_directory_uri() . '/blocks/' . $block . '/style.css', array(), filemtime( get_stylesheet_directory() . '/blocks/' . $block . '/style.css' ) );
			}
			if ( file_exists( get_stylesheet_directory() . '/blocks/' . $block . '/init.php' ) ) {
				include_once get_stylesheet_directory() . '/blocks/' . $block . '/init.php';
			}
			if ( file_exists( get_stylesheet_directory() . '/blocks/' . $block . '/ajax.php' ) ) {
				include_once get_stylesheet_directory() . '/blocks/' . $block . '/ajax.php';
			}
		}
	}
}
add_action( 'init', 'erd_load_blocks', 5 );

/**
 * Get Blocks
 */
function erd_get_blocks() {
	$blocks = scandir( get_stylesheet_directory() . '/blocks/' );
	$blocks = array_values( array_diff( $blocks, array( '..', '.', '.DS_Store', '_base-block' ) ) );
	return $blocks;
}
