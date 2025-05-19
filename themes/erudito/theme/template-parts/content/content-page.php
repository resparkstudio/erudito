<?php
/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package erudito
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php erd_post_thumbnail(); ?>

	<div <?php erd_content_class( 'entry-content' ); ?>>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div>' . __( 'Pages:', 'erd' ),
				'after' => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->



</article><!-- #post-<?php the_ID(); ?> -->