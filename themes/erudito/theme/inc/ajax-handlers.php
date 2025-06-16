<?php

/**
 * AJAX handler used for filtering products on WooCommerce products archive page
 */
function erd_filter_products() {
	check_ajax_referer( 'erd_ajax_nonce', 'nonce' );

	$category    = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';
	$category_id = isset( $_POST['category_id'] ) ? intval( $_POST['category_id'] ) : 0;
	$page        = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1;
	$orderby     = isset( $_POST['orderby'] ) ? sanitize_text_field( $_POST['orderby'] ) : 'menu_order';

	// Get WooCommerce products per page settings
	$products_per_page = wc_get_default_products_per_row() * wc_get_default_product_rows_per_page();

	// Set up the query
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => $products_per_page,
		'paged' => $page,
	);

	// Handle ordering
	if ( $orderby ) {
		switch ( $orderby ) {
			case 'popularity':
				$args['meta_key'] = 'total_sales';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				break;

			case 'date':
				$args['orderby'] = 'date';
				$args['order'] = 'DESC';
				break;

			case 'price':
				$args['meta_key'] = '_price';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'ASC';
				break;

			case 'price-desc':
				$args['meta_key'] = '_price';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				break;

			case 'menu_order':
			default:
				$args['orderby'] = 'menu_order title';
				$args['order'] = 'ASC';
				break;
		}
	}

	// Add category filter if not "all"
	if ( $category !== 'all' && $category_id > 0 ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => $category_id,
			),
		);
	}

	// Run the query
	$products = new WP_Query( $args );

	// Set up WooCommerce loop globals for pagination
	global $woocommerce_loop;
	$woocommerce_loop['total_pages']  = $products->max_num_pages;
	$woocommerce_loop['current_page'] = $page;

	// Output the products
	if ( $products->have_posts() ) {
		ob_start();
		while ( $products->have_posts() ) {
			$products->the_post();
			wc_get_template_part( 'content', 'product' );
		}
		$product_html = ob_get_clean();

		// Get pagination HTML
		ob_start();
		erd_custom_woocommerce_pagination();
		$pagination_html = ob_get_clean();

		// Return JSON response
		wp_send_json_success( array(
			'products' => $product_html,
			'pagination' => $pagination_html,
			'total_pages' => $products->max_num_pages,
			'current_page' => $page,
		) );
	} else {
		wp_send_json_error( '<div class="woocommerce-info">No products found in this category.</div>' );
	}

	wp_reset_postdata();
	wp_die();
}
add_action( 'wp_ajax_erd_filter_products', 'erd_filter_products' );
add_action( 'wp_ajax_nopriv_erd_filter_products', 'erd_filter_products' );


/**
 * AJAX handler that retrieves the amount of products in the cart
 */
function erd_get_cart_count() {
	check_ajax_referer( 'erd_ajax_nonce', 'nonce' );

	$cart_count = WC()->cart->get_cart_contents_count();

	wp_send_json_success( $cart_count );
}

add_action( 'wp_ajax_erd_get_product_count', 'erd_get_cart_count' );
add_action( 'wp_ajax_nopriv_erd_get_product_count', 'erd_get_cart_count' );


/**
 * WooCommerce single product add to cart AJAX handler
 */
function erd_ajax_add_to_cart_handler() {
	check_ajax_referer( 'erd_ajax_nonce', 'nonce' );
	$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
	$quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
	$variation_id      = empty( $_POST['variation_id'] ) ? 0 : absint( $_POST['variation_id'] );
	$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

	if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id ) ) {
		do_action( 'woocommerce_ajax_added_to_cart', $product_id );

		// Return fragments for updating the cart/
		WC_AJAX::get_refreshed_fragments();
	} else {
		// If there's an error, return the product URL for redirect
		wp_send_json( array(
			'error' => true,
			'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ),
		) );
	}

	wp_die();
}
add_action( 'wp_ajax_erd_single_ajax_add_to_cart', 'erd_ajax_add_to_cart_handler' );
add_action( 'wp_ajax_nopriv_erd_single_ajax_add_to_cart', 'erd_ajax_add_to_cart_handler' );



/**
 * Handler for storing product stock notification entries from single product form
 */
function erd_handle_preorder_notify() {
	check_ajax_referer( 'erd_ajax_nonce', 'nonce' );

	$email        = sanitize_email( $_POST['email'] );
	$product_id   = intval( $_POST['product_id'] );
	$variation_id = intval( $_POST['variation_id'] );

	if ( ! is_email( $email ) ) {
		wp_send_json_error( 'Please enter a valid email address' );
	}

	if ( ! $product_id ) {
		wp_send_json_error( 'Invalid product' );
	}

	global $wpdb;
	$table_name = $wpdb->prefix . 'product_preorders';

	// Check if already subscribed
	$existing = $wpdb->get_var( $wpdb->prepare(
		"SELECT id FROM $table_name WHERE email = %s AND product_id = %d AND variation_id = %d",
		$email,
		$product_id,
		$variation_id
	) );

	if ( $existing ) {
		wp_send_json_error( 'You\'re already subscribed for notifications on this product' );
	}

	// Insert new subscription
	$result = $wpdb->insert(
		$table_name,
		array(
			'email' => $email,
			'product_id' => $product_id,
			'variation_id' => $variation_id
		)
	);

	if ( $result === false ) {
		wp_send_json_error( 'Failed to save your subscription. Please try again.' );
	}

	wp_send_json_success( 'Subscription saved successfully' );
}
add_action( 'wp_ajax_handle_preorder_notify', 'erd_handle_preorder_notify' );
add_action( 'wp_ajax_nopriv_handle_preorder_notify', 'erd_handle_preorder_notify' );



/**
 * AJAX handler for applying coupons
 */
function erd_handle_apply_coupon_ajax() {
	check_ajax_referer( 'erd_ajax_nonce', 'nonce' );

	$coupon_code = sanitize_text_field( $_POST['coupon_code'] );

	if ( empty( $coupon_code ) ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a coupon code.', 'woocommerce' ) ) );
	}

	$result = WC()->cart->apply_coupon( $coupon_code );

	if ( $result ) {
		wp_send_json_success( array( 'message' => __( 'Coupon applied successfully!', 'woocommerce' ) ) );
	} else {
		wp_send_json_error( array( 'message' => __( 'The discount code is invalid. Please check that you have entered the code correctly.', 'woocommerce' ) ) );
	}
}

add_action( 'wp_ajax_erd_apply_coupon_ajax', 'erd_handle_apply_coupon_ajax' );
add_action( 'wp_ajax_nopriv_erd_apply_coupon_ajax', 'erd_handle_apply_coupon_ajax' );


/**
 * AJAX handler for removing all coupons
 */
function erd_handle_remove_all_coupons_ajax() {
	check_ajax_referer( 'erd_ajax_nonce', 'nonce' );

	$applied_coupons = WC()->cart->get_applied_coupons();

	if ( empty( $applied_coupons ) ) {
		wp_send_json_error( array( 'message' => __( 'No coupons to remove.', 'erudito' ) ) );
	}

	$removed_count = 0;
	foreach ( $applied_coupons as $coupon_code ) {
		if ( WC()->cart->remove_coupon( $coupon_code ) ) {
			$removed_count++;
		}
	}

	if ( $removed_count > 0 ) {
		wp_send_json_success( array(
			'message' => __( 'Coupon removed successfully!', 'erudito' ),
		) );
	} else {
		wp_send_json_error( array( 'message' => __( 'Error removing coupons.', 'erudito' ) ) );
	}
}
add_action( 'wp_ajax_erd_remove_coupon_ajax', 'erd_handle_remove_all_coupons_ajax' );
add_action( 'wp_ajax_nopriv_erd_remove_coupon_ajax', 'erd_handle_remove_all_coupons_ajax' );


/**
 * AJAX handler for updating cart quantity
 */
function erd_handle_update_cart_quantity_ajax() {
	check_ajax_referer( 'erd_ajax_nonce', 'nonce' );

	$cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );
	$quantity      = intval( $_POST['quantity'] );

	if ( empty( $cart_item_key ) ) {
		wp_send_json_error( array( 'message' => __( 'Invalid cart item.', 'erudito' ) ) );
	}

	// Get cart item to validate
	$cart_item = WC()->cart->get_cart_item( $cart_item_key );
	if ( ! $cart_item ) {
		wp_send_json_error( array( 'message' => __( 'Cart item not found.', 'erudito' ) ) );
	}

	// Update quantity
	$updated = WC()->cart->set_quantity( $cart_item_key, $quantity );
	if ( $updated ) {
		wp_send_json_success( array(
			'message' => sprintf( __( 'Quantity updated to %d.', 'erudito' ), $quantity )
		) );
	} else {
		wp_send_json_error( array( 'message' => __( 'Failed to update quantity.', 'erudito' ) ) );
	}
}
add_action( 'wp_ajax_erd_update_cart_quantity', 'erd_handle_update_cart_quantity_ajax' );
add_action( 'wp_ajax_nopriv_erd_update_cart_quantity', 'erd_handle_update_cart_quantity_ajax' );



/**
 * AJAX handler for removing cart items
 */
function erd_handle_remove_cart_item_ajax() {
	check_ajax_referer( 'erd_ajax_nonce', 'nonce' );

	$cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );

	if ( empty( $cart_item_key ) ) {
		wp_send_json_error( array( 'message' => __( 'Invalid cart item.', 'erudito' ) ) );
	}

	// Verify cart item exists
	$cart_item = WC()->cart->get_cart_item( $cart_item_key );
	if ( ! $cart_item ) {
		wp_send_json_error( array( 'message' => __( 'Cart item not found.', 'erudito' ) ) );
	}

	$removed = WC()->cart->remove_cart_item( $cart_item_key );

	if ( $removed ) {
		wp_send_json_success( array(
			'message' => __( 'Item removed from cart.', 'erudito' )
		) );
	} else {
		wp_send_json_error( array( 'message' => __( 'Failed to remove item.', 'erudito' ) ) );
	}
}
add_action( 'wp_ajax_erd_remove_cart_item', 'erd_handle_remove_cart_item_ajax' );
add_action( 'wp_ajax_nopriv_erd_remove_cart_item', 'erd_handle_remove_cart_item_ajax' );


/**
 * AJAX handler for news filter
 */
function erd_filter_news() {
	check_ajax_referer( 'erd_ajax_nonce', 'nonce' );

	$category = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : 'all';

	$args = array(
		'post_type' => 'news',
		'posts_per_page' => -1
	);

	if ( $category !== 'all' ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $category,
			),
		);
	}

	$news_query = new WP_Query( $args );


	if ( $news_query->have_posts() ) {
		ob_start();
		get_template_part( 'template-parts/content', 'news', array(
			'news' => $args,
		) );

		wp_send_json_success( array(
			'html' => ob_get_clean(),
		) );

	} else {
		wp_send_json_error( __( 'No news found.', 'erudito' ) );
	}

	wp_die();
}

add_action( 'wp_ajax_erd_filter_news', 'erd_filter_news' );
add_action( 'wp_ajax_nopriv_erd_filter_news', 'erd_filter_news' );