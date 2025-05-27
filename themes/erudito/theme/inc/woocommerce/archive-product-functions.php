<?php

/**
 * All functions that are related to archive-product.php WooCommerce template
 */


/**
 * Removing default WooCommerce actions from the template
 */
function erd_remove_woocommerce_archive_actions() {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
    remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
    remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
}
add_action('init', 'erd_remove_woocommerce_archive_actions', 99);


function erd_archive_hero_section() {
    $description = '';
    $shop_page_id = wc_get_page_id('shop');

    $left_image = get_field('left_image', $shop_page_id);
    $right_image = get_field('right_image', $shop_page_id);

    if ($shop_page_id > 0) {
        $shop_page = get_post($shop_page_id);

        if ($shop_page && !empty($shop_page->post_content)) {
            $description = apply_filters('the_content', $shop_page->post_content);
        }
    }

    $product_categories = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ]);

    // Check if a category filter is active
    $current_category_slug = '';

    // If we're on a category archive page, get the current category
    if (is_product_category()) {
        $current_category = get_queried_object();
        $current_category_slug = $current_category->slug;
    }
    // If we're on the shop page with a product_cat query parameter
    elseif (isset($_GET['product_cat'])) {
        $current_category_slug = sanitize_text_field($_GET['product_cat']);
    }

    // Base classes for all filter buttons
    $filter_base_classes = "text-body-m-medium py-2.5 block px-4 rounded-full text-white duration-200 hover:opacity-100";
    // Active state classes
    $filter_active_classes = "bg-[#394173]";
    // Inactive state classes
    $filter_inactive_classes = "opacity-50";
?>
    <section class="relative w-full px-5 pt-12 pb-8 overflow-hidden bg-blue md:pt-26 md:pb-46.5 md:flex md:flex-col md:items-center">
        <div class="flex flex-col items-center gap-4 px-4 text-center lg:gap-6">
            <h1 class="text-white text-title-l-mobile lg:text-title-xl">
                <?php
                // Get the title of the designated shop page
                echo get_the_title($shop_page_id);
                ?>
            </h1>
            <?php if ($description) : ?>
                <div class="text-white text-body-m-light md:max-w-[31.25rem]">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($product_categories) && !is_wp_error($product_categories)) : ?>
            <div class="w-screen -ml-5 overflow-x-scroll no-scrollbar md:w-auto">
                <ul class="flex px-5 mt-8 min-w-max md:min-w-0 md:mt-12">
                    <li>
                        <a class="<?php echo esc_attr($filter_base_classes); ?> <?php echo empty($current_category_slug) ? $filter_active_classes : $filter_inactive_classes; ?>"
                            data-category-filter-btn
                            data-category="all"
                            data-category-id="0"
                            href="">
                            <?php echo esc_html__('All products', 'erudito'); ?>
                        </a>
                    </li>

                    <?php foreach ($product_categories as $category) :
                        $is_active = $current_category_slug === $category->slug;
                    ?>
                        <li>
                            <a class="<?php echo esc_attr($filter_base_classes); ?> <?php echo $is_active ? $filter_active_classes : $filter_inactive_classes; ?>"
                                data-category-filter-btn
                                data-category="<?php echo esc_attr($category->slug); ?>"
                                data-category-id="<?php echo esc_attr($category->term_id); ?>"
                                href="">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <li class="w-5 shrink-0"></li>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($left_image) : ?>
            <img src="<?php echo esc_url($left_image['url']); ?>"
                alt="<?php esc_attr($left_image['alt']); ?>"
                class="absolute left-0 max-h-120 top-4.5 hidden lg:block">
        <?php endif; ?>

        <?php if ($right_image) : ?>
            <img src="<?php echo esc_url($right_image['url']); ?>"
                alt="<?php esc_attr($right_image['alt']); ?>"
                class="absolute right-0 hidden max-h-120 top-8 lg:block">
        <?php endif; ?>

    </section>
<?php
}
add_action('woocommerce_shop_loop_header', 'erd_archive_hero_section', 1);


function erd_archive_grid_layout() {
    // Add your custom Tailwind classes here
    add_filter('woocommerce_product_loop_start', function ($markup) {
        // Replace the <ul> markup with a custom grid layout
        $markup = '<ul id="products-grid" class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-8 lg:gap-12">';
        return $markup;
    });
}
add_action('woocommerce_before_shop_loop', 'erd_archive_grid_layout', 5);



/**
 * Output opening div for the archive content
 */
function erd_archive_content_start() {
    echo '<div id="archive-content" class="px-5 pt-8 pb-12">';
}
add_action('woocommerce_before_shop_loop', 'erd_archive_content_start', 1);

/**
 * Output closing div for the archive content
 */
function erd_archive_content_end() {
    echo '</div>';
}
add_action('woocommerce_after_shop_loop', 'erd_archive_content_end', 20);


/**
 * Custom archive pagination
 */
function erd_custom_woocommerce_pagination() {
    global $woocommerce_loop;

    if ($woocommerce_loop['total_pages'] <= 1) {
        return;
    }

    // Check if current_page is set in woocommerce_loop (from AJAX)
    // Otherwise fall back to get_query_var for initial page load
    $current_page = isset($woocommerce_loop['current_page']) ?
        $woocommerce_loop['current_page'] :
        max(1, get_query_var('paged'));

    $total_pages = $woocommerce_loop['total_pages'];

    // Fix: Don't generate URLs in AJAX context, JS will handle it
    $prev_page = $current_page - 1;
    $next_page = $current_page + 1;

    // Page numbers logic
    $end_size = 3;
    $mid_size = 2;
?>


    <nav class="flex items-center justify-between gap-6 mt-8 lg:mt-20 lg:justify-center lg:gap-8" aria-label="Product pagination">
        <!-- Prev button -->
        <a class="erd_button is-secondary !p-0 flex items-center justify-center w-10 h-10 lg:w-12 lg:h-12 rounded-full text-black bg-gray <?php echo esc_attr($current_page <= 1 ? "pointer-events-none" : ""); ?>" href="#" data-page="<?php echo esc_attr($prev_page); ?>">
            <svg class="w-6 h-6 <?php echo esc_attr($current_page <= 1 ? "opacity-50" : ""); ?>" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 7C10.093 10.0531 7.21964 11.9966 4 11.9966C7.21964 11.9966 10.093 13.94 12 17" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
                <path d="M4 12L20 12" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
            </svg>
        </a>

        <!-- Pagination -->
        <div class="flex gap-6">
            <?php
            // Always show first pages
            for ($i = 1; $i <= min($end_size, $total_pages); $i++) {
                echo erd_build_pagination_link($i, $current_page);
            }

            // Show dots if needed
            if ($current_page - $mid_size > $end_size + 1) {
                echo '<span class="px-3 py-2 text-gray-500 page-numbers dots">...</span>';
            }

            // Show pages around current page
            $start = max($end_size + 1, $current_page - $mid_size);
            $end = min($total_pages - $end_size, $current_page + $mid_size);

            for ($i = $start; $i <= $end; $i++) {
                echo erd_build_pagination_link($i, $current_page);
            }

            // Show dots if needed
            if ($current_page + $mid_size < $total_pages - $end_size) {
                echo '<span class="px-3 py-2 text-gray-500 page-numbers dots">...</span>';
            }

            // Always show last pages
            for ($i = max($total_pages - $end_size + 1, $end_size + 1); $i <= $total_pages; $i++) {
                if ($i > $end) {
                    echo erd_build_pagination_link($i, $current_page);
                }
            }
            ?>
        </div>
        <!-- Next button -->
        <a class="erd_button is-secondary !p-0 flex items-center justify-center w-10 h-10 lg:w-12 lg:h-12 text-black rounded-full bg-gray <?php echo esc_attr($current_page >= $total_pages ? "pointer-events-none" : ""); ?>" href="#" data-page="<?php echo esc_attr($next_page); ?>">
            <svg class="w-6 h-6 <?php echo esc_attr($current_page >= $total_pages ? "opacity-50" : ""); ?>" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 7C13.907 10.0531 16.7804 11.9966 20 11.9966C16.7804 11.9966 13.907 13.94 12 17" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
                <path d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
            </svg>
        </a>
    </nav>
<?php
}


function erd_build_pagination_link($page, $current_page) {

    if ($page == $current_page) {
        return '<span class="flex items-center justify-center w-6 h-6 text-black text-button" aria-current="page">' . $page . '</span>';
    } else {
        return '<a href="#" class="flex items-center justify-center w-6 h-6 duration-200 text-gray4 lg:hover:text-black text-button pagination-link" data-page="' . $page . '">' . $page . '</a>';
    }
}
add_action('woocommerce_after_shop_loop', 'erd_custom_woocommerce_pagination', 10);


/**
 * Render custom products order dropdown
 */
function erd_custom_order_dropdown() {
    $current_orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'menu_order';
?>
    <div class="grid grid-cols-2 mb-6 lg:grid-cols-4 gap-x-4 lg:gap-12">
        <?php
        erd_render_dropdown(array(
            'id' => 'archive-order-dropdown',
            // 'id' => $current_orderby,
            'options' => array(
                'menu_order' => __('Default sorting', 'erudito'),
                'popularity' => __('Sort by popularity', 'erudito'),
                'date' => __('Sort by latest', 'erudito'),
                'price' => __('Sort by price: low to high', 'erudito'),
                'price-desc' => __('Sort by price: high to low', 'erudito')
            ),
            'selected' => $current_orderby,
            'class' => 'col-span-2 lg:col-span-1'
        ));
        ?>
    </div>
<?php
}
add_action('woocommerce_before_shop_loop', 'erd_custom_order_dropdown', 30);
