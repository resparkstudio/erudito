<?php

/**
 * erudito functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package erudito
 */

if ( ! defined( 'ERD_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'ERD_VERSION', '0.1.11' );
}

if ( ! defined( 'ERD_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `erd_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'ERD_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'erd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function erd_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on erudito, use a find and replace
		 * to change 'erudito' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'erudito', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'erudito' ),
				'menu-2' => __( 'Footer Menu', 'erudito' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );

		// Add basic WooCommerce support
		add_theme_support( 'woocommerce' );

		// Remove all WooCommerce default CSS styles
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	}
endif;
add_action( 'after_setup_theme', 'erd_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function erd_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Footer', 'erudito' ),
			'id' => 'sidebar-1',
			'description' => __( 'Add widgets here to appear in your footer.', 'erudito' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'erd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function erd_scripts() {
	wp_enqueue_style( 'erudito-style', get_stylesheet_uri(), array(), ERD_VERSION );
	wp_enqueue_script( 'erudito-script', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ), ERD_VERSION, true );
	wp_enqueue_script( 'wc-cart-fragments' );


	// Always localize basic data (notifications can happen anywhere)
	$localize_data = array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'erd_ajax_nonce' ),
		// Notification messages
		'messages' => array(
			'added_to_cart' => __( 'Product added to cart', 'erudito' ),
			'removed_from_cart' => __( 'Product removed from cart', 'erudito' ),
			'cart_updated' => __( 'Cart updated', 'erudito' ),
			'error_generic' => __( 'Something went wrong. Please try again.', 'erudito' ),
			'stock_notification_success' => __( 'We\'ll inform you when product is back in stock', 'erudito' ),
			'stock_notification_error' => __( 'You\'ve already subscribed!', 'erudito' ),
			'empty_coupon' => __( 'Please enter a coupon code', 'erudito' ),
		)
	);

	// Add shop-specific data only on relevant pages
	if ( is_shop() || is_product_category() || is_product() ) {
		$localize_data['shop_url']          = get_permalink( wc_get_page_id( 'shop' ) );
		$localize_data['products_per_page'] = wc_get_default_products_per_row() * wc_get_default_product_rows_per_page();
	}

	wp_localize_script( 'erudito-script', 'erdAjaxData', $localize_data );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'erd_scripts' );

/**
 * Enqueue the block editor script.
 */
function erd_enqueue_block_editor_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'erudito-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			ERD_VERSION,
			true
		);
		wp_add_inline_script( 'erudito-editor', "tailwindTypographyClasses = '" . esc_attr( ERD_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'erd_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function erd_tinymce_add_class( $settings ) {
	$settings['body_class'] = ERD_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'erd_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG icons functions and filters.
 */
require get_template_directory() . '/inc/svg-icons.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Blocks.
 */
require get_template_directory() . '/inc/blocks.php';

/**
 * Components
 */
require get_template_directory() . '/inc/components.php';

/**
 * All AJAX handlers
 */
require get_template_directory() . '/inc/ajax-handlers.php';

/**
 * WooCommerce functions
 */
require get_template_directory() . '/inc/woocommerce/archive-product-functions.php';
require get_template_directory() . '/inc/woocommerce/content-product-functions.php';
require get_template_directory() . '/inc/woocommerce/content-single-product-functions.php';
require get_template_directory() . '/inc/woocommerce/cart-page-functions.php';
require get_template_directory() . '/inc/woocommerce/floating-cart.php';
require get_template_directory() . '/inc/woocommerce/price-format.php';
require get_template_directory() . '/inc/woocommerce/product-stock-notifier.php';
require get_template_directory() . '/inc/woocommerce/product-qty-input.php';
require get_template_directory() . '/inc/woocommerce/fragments.php';
