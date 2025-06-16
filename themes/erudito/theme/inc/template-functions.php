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
		$title = __( 'Category Archives: ', 'erd' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = __( 'Tag Archives: ', 'erd' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = __( 'Author Archives: ', 'erd' ) . '<span>' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = __( 'Yearly Archives: ', 'erd' ) . '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'erd' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = __( 'Monthly Archives: ', 'erd' ) . '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'erd' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = __( 'Daily Archives: ', 'erd' ) . '<span>' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$cpt   = get_post_type_object( get_queried_object()->name );
		$title = sprintf(
			/* translators: %s: Post type singular name */
			esc_html__( '%s Archives', 'erd' ),
			$cpt->labels->singular_name
		);
	} elseif ( is_tax() ) {
		$tax   = get_taxonomy( get_queried_object()->taxonomy );
		$title = sprintf(
			/* translators: %s: Taxonomy singular name */
			esc_html__( '%s Archives', 'erd' ),
			$tax->labels->singular_name
		);
	} else {
		$title = __( 'Archives:', 'erd' );
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
			wp_kses( __( 'Continue reading %s', 'erd' ), array( 'span' => array( 'class' => array() ) ) ),
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
		$moderation_note = __( 'Your comment is awaiting moderation.', 'erd' );
	} else {
		$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'erd' );
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
						wp_kses_post( __( '%s <span class="says">says:</span>', 'erd' ) ),
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
								__( '%1$s at %2$s', 'erd' ),
								get_comment_date( '', $comment ),
								get_comment_time()
							)
						)
					);

					edit_comment_link( __( 'Edit', 'erd' ), ' <span class="edit-link">', '</span>' );
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

function erd_section_text( $heading, $description, $button = null, $max_width = '' ) {
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
			<?php if ( $button ) : ?>
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button mt-6 lg:mt-8">
					<?php echo esc_html( $button['title'] ); ?>
				</a>
			<?php endif; ?>
		</div>
		<?php
}

function erd_tab( $index, $title, $small = false ) {
	?>
		<button
			class="relative w-full cursor-pointer <?php echo $small ? 'max-w-[13.3125rem]' : 'max-w-[18.3125rem]' ?> <?php echo $index === 0 ? 'z-10' : '' ?> <?php echo $index !== 0 ? '-translate-x-4' : '' ?>"
			@click="openTab = <?php echo $index; ?>, filterSelected = ''">
			<svg class="text-[#E6EAF2] w-full" x-bind:class="{ '!text-white' : openTab === <?php echo $index; ?> }"
				viewBox="0 0 293 72" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M250.182 7.1248C247.244 2.67362 242.298 0 237.001 0H8C3.58172 0 0 3.58172 0 8V72H293.001L250.182 7.1248Z"
					fill="currentColor" />
			</svg>
			<span
				class="absolute top-1/2 -translate-y-1/2 left-[2.25rem] text-title-s-mobile <?php echo $small ? 'lg:text-title-xs' : 'lg:text-title-s' ?> font-argent">
				<?php echo esc_html( $title ); ?>
			</span>
		</button>
		<?php
}

function erd_register_button( $text = '' ) {
	?>
		<button class="erd_button" @click="registerModalOpen = true">
			<?php echo esc_html( $text ?: __( 'Registruotis apsilankymui', 'erudito' ) ); ?>
		</button>
		<?php
}

function erd_accordion_item( $heading, $description, $index, $top_border = false, $hover_class = 'group-hover:bg-white', $align_right_mobile = false ) {
	?>
		<div class="w-full border-b border-gray3  <?php echo $top_border ? 'first:border-t' : 'last:border-b-0'; ?>"
			x-data="{ open: <?php echo $index === 0 ? 'true' : 'false'; ?> }">
			<h2 id="heading-<?php echo esc_attr( $index ); ?>">
				<button
					class="text-title-s-mobile lg:text-title-s flex items-center gap-4 lg:gap-6 group cursor-pointer text-left py-5 lg:py-7 <?php echo $align_right_mobile ? 'flex-row-reverse lg:flex-row justify-between lg:justify-start w-full' : '' ?>"
					type="button" aria-controls="collapse-<?php echo esc_attr( $index ); ?>" @click="open = !open">
					<div
						class="<?php echo esc_attr( $hover_class ); ?> group-hover:rounded-full p-1 transition-all duration-300 ease-in-out">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
							x-show="open">
							<path d="M19 12L5 12" stroke="black" stroke-width="1.5" stroke-miterlimit="10"
								stroke-linecap="square" />
						</svg>

						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
							x-show="!open">
							<path d="M19 12L5 12" stroke="black" stroke-width="1.5" stroke-miterlimit="10"
								stroke-linecap="square" />
							<path d="M12 5L12 19" stroke="black" stroke-width="1.5" stroke-miterlimit="10"
								stroke-linecap="square" />
						</svg>
					</div>
					<?php echo esc_html( $heading ); ?>
				</button>
			</h2>
			<div id="collapse-<?php echo esc_attr( $index ); ?>" aria-labelledby="heading-<?php echo esc_attr( $index ); ?>"
				x-show="open" x-collapse>
				<div class="text-body-m-light lg:pl-12 pb-5 lg:pb-7 <?php echo $align_right_mobile ? '' : 'pl-12'; ?>">
					<?php echo wp_kses_post( $description ); ?>
				</div>
			</div>
		</div>
		<?php
}

add_action( 'woocommerce_review_order_before_submit', 'bbloomer_add_checkout_privacy_policy', 9 );

function bbloomer_add_checkout_privacy_policy() {

	woocommerce_form_field( 'privacy_policy', array(
		'type' => 'checkbox',
		'class' => array( 'form-row privacy' ),
		'label_class' => array( 'woocommerce-form__label woocommerce-form__label-for-checkbox checkbox terms-checkbox' ),
		'input_class' => array( 'woocommerce-form__input woocommerce-form__input-checkbox input-checkbox' ),
		'required' => true,
		'label' => __( 'Sutinku su  <a href="' . esc_url( get_privacy_policy_url() ) . '" target="_blank" rel="noopener noreferrer">pirkimo sąlygomis</a>', 'woocommerce' ),
	) );
}


add_action( 'woocommerce_checkout_process', 'bbloomer_not_approved_privacy' );

function bbloomer_not_approved_privacy() {
	if ( ! (int) isset( $_POST['privacy_policy'] ) ) {
		wc_add_notice( __( 'Please acknowledge the Privacy Policy' ), 'error' );
	}
}

function custom_shipping_method_label( $label, $method ) {
	$label = str_replace( 'Free shipping:', 'Free Shipping (3-5 days)', $label );
	$label = str_replace( 'Flat rate:', '', $label );
	$label = str_replace( 'Flat:', '', $label );

	return $label;
}

add_filter( 'woocommerce_cart_shipping_method_full_label', 'custom_shipping_method_label', 10, 2 );

add_action( 'woocommerce_after_order_details', 'wpo_wcpdf_thank_you_link', 10, 1 );
function wpo_wcpdf_thank_you_link( $order ) {
	$text      = '';
	$pdf_url   = add_query_arg( array(
		'action' => 'generate_wpo_wcpdf',
		'document_type' => 'invoice',
		'order_ids' => $order->get_id(),
		'order_key' => $order->get_order_key(),
	), admin_url( 'admin-ajax.php' ) );
	$link_text = 'Download a printable invoice / payment confirmation (PDF format)';
	$text .= sprintf( '<p><a href="%s">%s</a></p>', esc_attr( $pdf_url ), esc_html( $link_text ) );
	return $text;
}


add_filter( 'default_checkout_billing_country', 'erd_change_default_checkout_country' );
add_filter( 'default_checkout_billing_state', 'erd_change_default_checkout_state' );
function erd_change_default_checkout_country() {
	return null;
}
function erd_change_default_checkout_state() {
	return null;
}

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20 );


add_action( 'woocommerce_checkout_fields', 'wpdesk_vat_number_checkout_field' );
/**
 * Add VAT Number to WooCommerce Checkout
 */

function wpdesk_vat_number_checkout_field( $fields ) {

	$fields['billing']['billing_first_name']['placeholder'] = __( 'Your name' );
	$fields['billing']['billing_first_name']['class']       = 'form-row-wide form-row-first float-left lg:max-w-[50%] !w-full lg:!pr-[0.625rem]';
	$fields['billing']['billing_last_name']                 = array(
		'label' => __( 'Last Name', 'woocommerce' ),
		'required' => true,
		'clear' => true,
		'class' => 'form-row-wide form-row-last lg:max-w-[50%] !w-full !clear-end lg:!pl-[0.625rem]',
		'placeholder' => __( 'Last name' ),
	);
	$fields['billing']['billing_email']['label']            = __( 'Email' );
	$fields['billing']['billing_email']['placeholder']      = __( 'Your email address' );
	$fields['billing']['billing_email']['class']            = 'form-row-wide form-row-first float-left lg:max-w-[50%] !w-full lg:!pr-[0.625rem]';
	$fields['billing']['billing_email']['priority']         = 1;

	$fields['billing']['billing_phone']['priority']       = 2;
	$fields['billing']['billing_phone']['placeholder']    = __( 'Your phone number' );
	$fields['billing']['billing_phone']['class']          = 'form-row-wide form-row-last lg:max-w-[50%] !w-full !clear-end lg:!pl-[0.625rem]';
	$fields['billing']['billing_country']['label']        = __( 'Country' );
	$fields['billing']['billing_country']['class']        = 'form-row-wide form-row-first lg:max-w-[50%] float-left !w-full lg:!pr-[0.625rem]';
	$fields['billing']['billing_city']['priority']        = 40;
	$fields['billing']['billing_city']['class']           = 'form-row-wide form-row-first lg:max-w-[50%] !w-full lg:!pl-[0.625rem]';
	$fields['billing']['billing_city']['label']           = __( 'City' );
	$fields['billing']['billing_city']['placeholder']     = __( 'City' );
	$fields['billing']['billing_postcode']['label']       = __( 'ZIP Code' );
	$fields['billing']['billing_postcode']['placeholder'] = __( 'e.g., 12345' );
	$fields['billing']['billing_postcode']['priority']    = 45;
	$fields['billing']['billing_postcode']['class']       = 'form-row-wide form-row-last lg:max-w-[25%] !w-full lg:float-right !clear-end lg:!pl-[0.625rem]';

	unset( $fields['billing']['billing_state'] );
	unset( $fields['shipping']['shipping_state'] );
	unset( $fields['order']['order_comments'] );

	return $fields;
}

add_filter( 'woocommerce_cart_needs_shipping', 'filter_cart_needs_shipping' );
function filter_cart_needs_shipping( $needs_shipping ) {
	if ( is_cart() ) {
		$needs_shipping = false;
	}
	return $needs_shipping;
}

function erd_modal( $heading, $content ) {
	?>
		<div @keydown.escape.window="modalOpen = false" class="relative z-50 w-auto h-auto">
			<template x-teleport="body">
				<div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
					x-cloak>
					<div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
						x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
						x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false"
						class="absolute inset-0 w-full h-full bg-black/30"></div>
					<div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300"
						x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
						x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
						x-transition:leave="ease-in duration-200"
						x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
						x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
						class="px-5 w-full lg:px-0">
						<div class="relative mx-auto w-full p-5 lg:p-8 bg-white sm:max-w-[29rem]">
							<div class="flex items-center justify-between pb-4">
								<h3 class="text-title-m-mobile lg:text-title-s">
									<?php echo esc_html( $heading ); ?>
								</h3>
								<button @click="modalOpen=false"
									class="absolute top-4 right-4 flex items-center justify-center w-8 h-8 rounded-full cursor-pointer hover:bg-gray-50">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M5 19L19 5" stroke="#181B2B" stroke-miterlimit="10"
											stroke-linecap="square" />
										<path d="M19 19L5 5" stroke="#181B2B" stroke-miterlimit="10"
											stroke-linecap="square" />
									</svg>
								</button>
							</div>
							<div class="relative w-auto [&_ul]:list-disc">
								<?php echo htmlspecialchars_decode( $content ); ?>
							</div>
						</div>
					</div>
				</div>
			</template>
		</div>
		<?php
}

function erd_video_player_popup( $videos ) {
	?>
		<div x-show="videoPlayerOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
			x-cloak>
			<div x-show="videoPlayerOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
				x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
				x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="videoPlayerOpen=false"
				class="absolute inset-0 w-full h-full bg-black/30"></div>
			<div x-show="videoPlayerOpen" x-trap.inert.noscroll="videoPlayerOpen" x-transition:enter="ease-out duration-300"
				x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
				x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
				x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="px-5 w-full lg:px-0">
				<div class="relative mx-auto w-full p-5 lg:p-8 bg-white sm:max-w-[29rem]">
					<div class="flex items-center justify-between pb-4">

						<button @click="videoPlayerOpen=false"
							class="absolute top-4 right-4 flex items-center justify-center w-8 h-8 rounded-full cursor-pointer hover:bg-gray-50">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5 19L19 5" stroke="#181B2B" stroke-miterlimit="10" stroke-linecap="square" />
								<path d="M19 19L5 5" stroke="#181B2B" stroke-miterlimit="10" stroke-linecap="square" />
							</svg>
						</button>
					</div>
					<div class="relative w-auto [&_ul]:list-disc">
						<?php foreach ( $videos as $index => $video ) : ?>
							<div class="mb-4" x-show="currentIndex === <?php echo $index; ?>">
								<?php var_dump( $video ); ?>
							</div>
						<?php endforeach; ?>

						<div>
							<div class="flex justify-between items-center">
								<button @click="currentIndex = (currentIndex - 1 + videos.length) % videos.length"
									class="text-body-m-light cursor-pointer">
									&laquo; Previous
								</button>

								<button @click="currentIndex = (currentIndex + 1) % videos.length"
									class="text-body-m-light cursor-pointer">
									Next &raquo;
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
}