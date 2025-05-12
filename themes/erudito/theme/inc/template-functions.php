<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package erudito
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function erd_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'erd_pingback_header' );

/**
 * Changes comment form default fields.
 *
 * @param array $defaults The default comment form arguments.
 *
 * @return array Returns the modified fields.
 */
function erd_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'erd_comment_form_defaults' );

/**
 * Filters the default archive titles.
 */
function erd_get_the_archive_title() {
	if ( is_category() ) {
		$title = __( 'Category Archives: ', 'erudito' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = __( 'Tag Archives: ', 'erudito' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = __( 'Author Archives: ', 'erudito' ) . '<span>' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = __( 'Yearly Archives: ', 'erudito' ) . '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'erudito' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = __( 'Monthly Archives: ', 'erudito' ) . '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'erudito' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = __( 'Daily Archives: ', 'erudito' ) . '<span>' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$cpt   = get_post_type_object( get_queried_object()->name );
		$title = sprintf(
			/* translators: %s: Post type singular name */
			esc_html__( '%s Archives', 'erudito' ),
			$cpt->labels->singular_name
		);
	} elseif ( is_tax() ) {
		$tax   = get_taxonomy( get_queried_object()->taxonomy );
		$title = sprintf(
			/* translators: %s: Taxonomy singular name */
			esc_html__( '%s Archives', 'erudito' ),
			$tax->labels->singular_name
		);
	} else {
		$title = __( 'Archives:', 'erudito' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'erd_get_the_archive_title' );

/**
 * Determines whether the post thumbnail can be displayed.
 */
function erd_can_show_post_thumbnail() {
	return apply_filters( 'erd_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
 * Returns the size for avatars used in the theme.
 */
function erd_get_avatar_size() {
	return 60;
}

/**
 * Create the continue reading link
 *
 * @param string $more_string The string shown within the more link.
 */
function erd_continue_reading_link( $more_string ) {

	if ( ! is_admin() ) {
		$continue_reading = sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s', 'erudito' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="sr-only">"', '"</span>', false )
		);

		$more_string = '<a href="' . esc_url( get_permalink() ) . '">' . $continue_reading . '</a>';
	}

	return $more_string;
}

// Filter the excerpt more link.
add_filter( 'excerpt_more', 'erd_continue_reading_link' );

// Filter the content more link.
add_filter( 'the_content_more_link', 'erd_continue_reading_link' );

/**
 * Outputs a comment in the HTML5 format.
 *
 * This function overrides the default WordPress comment output in HTML5
 * format, adding the required class for Tailwind Typography. Based on the
 * `html5_comment()` function from WordPress core.
 *
 * @param WP_Comment $comment Comment to display.
 * @param array      $args    An array of arguments.
 * @param int        $depth   Depth of the current comment.
 */
function erd_html5_comment( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

	$commenter          = wp_get_current_commenter();
	$show_pending_links = ! empty( $commenter['comment_author'] );

	if ( $commenter['comment_author_email'] ) {
		$moderation_note = __( 'Your comment is awaiting moderation.', 'erudito' );
	} else {
		$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'erudito' );
	}
	?>
	<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment->has_children ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
					if ( 0 !== $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					}
					?>
					<?php
					$comment_author = get_comment_author_link( $comment );

					if ( '0' === $comment->comment_approved && ! $show_pending_links ) {
						$comment_author = get_comment_author( $comment );
					}

					printf(
						/* translators: %s: Comment author link. */
						wp_kses_post( __( '%s <span class="says">says:</span>', 'erudito' ) ),
						sprintf( '<b class="fn">%s</b>', wp_kses_post( $comment_author ) )
					);
					?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<?php
					printf(
						'<a href="%s"><time datetime="%s">%s</time></a>',
						esc_url( get_comment_link( $comment, $args ) ),
						esc_attr( get_comment_time( 'c' ) ),
						esc_html(
							sprintf(
								/* translators: 1: Comment date, 2: Comment time. */
								__( '%1$s at %2$s', 'erudito' ),
								get_comment_date( '', $comment ),
								get_comment_time()
							)
						)
					);

					edit_comment_link( __( 'Edit', 'erudito' ), ' <span class="edit-link">', '</span>' );
					?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' === $comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation"><?php echo esc_html( $moderation_note ); ?></em>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div <?php erd_content_class( 'comment-content' ); ?>>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
			if ( '1' === $comment->comment_approved || $show_pending_links ) {
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth' => $depth,
							'max_depth' => $args['max_depth'],
							'before' => '<div class="reply">',
							'after' => '</div>',
						)
					)
				);
			}
			?>
		</article><!-- .comment-body -->
		<?php
}

function erd_build_menu_tree( $menu, $parent_id ) {
	$branch = array();

	foreach ( $menu as $item ) {
		if ( $item->menu_item_parent == $parent_id ) {
			$children = erd_build_menu_tree( $menu, $item->ID );

			if ( $children ) {
				$item->children = $children;
			}

			$branch[] = array(
				'ID' => $item->ID,
				'title' => $item->title,
				'url' => $item->url,
				'children' => $children ?? null,
				'parentID' => $item->menu_item_parent,
			);
		}
	}

	return $branch;
}

function erd_menu_builder( $menu_id = '' ) {
	$menu = wp_get_nav_menu_items( $menu_id );
	return erd_build_menu_tree( $menu, 0 );
}

add_filter( 'wp_get_nav_menu_items', 'erd_wp_get_nav_menu_items', 10, 3 );
function erd_wp_get_nav_menu_items( $items ) {
	foreach ( $items as $key => $item )
		$items[ $key ]->description = '';

	return $items;
}

function erd_hero_text( $heading, $description, $max_width = '', $description_max_width = '' ) {
	?>
		<div class="<?php echo esc_attr( $max_width ); ?> text-center mx-auto"
			style="max-width: <?php echo esc_attr( $max_width ); ?>;">
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-xl text-center mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="text-body-m-light text-center mx-auto"
					style="max-width: <?php echo esc_attr( $description_max_width ); ?>;">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
		</div>
		<?php
}

function erd_section_text( $heading, $description, $max_width = '' ) {
	?>
		<div class="" style="max-width: <?php echo esc_attr( $max_width ); ?>;">
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="text-body-m-light">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
		</div>
		<?php
}

function erd_tab( $index, $title ) {
	?>
		<button
			class="relative w-full max-w-[18.3125rem] cursor-pointer <?php echo $index === 0 ? 'z-10' : '' ?> <?php echo $index !== 0 ? '-translate-x-4' : '' ?>"
			@click="openTab = <?php echo $index; ?>">
			<svg class="text-[#E6EAF2] w-full" x-bind:class="{ '!text-white' : openTab === <?php echo $index; ?> }"
				viewBox="0 0 293 72" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M250.182 7.1248C247.244 2.67362 242.298 0 237.001 0H8C3.58172 0 0 3.58172 0 8V72H293.001L250.182 7.1248Z"
					fill="currentColor" />
			</svg>
			<span class="absolute top-1/2 -translate-y-1/2 left-[2.25rem] text-title-s-mobile lg:text-title-s font-argent">
				<?php echo esc_html( $title ); ?>
			</span>
		</button>
		<?php
}