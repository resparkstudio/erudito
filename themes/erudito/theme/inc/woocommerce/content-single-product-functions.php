<?php

/**
 * All functions that are related to content-single-product.php WooCommerce template
 */

/**
 * Removing default WooCommerce actions from the template
 */
function erd_remove_woocommerce_single_product_actions() {
    remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}
add_action('init', 'erd_remove_woocommerce_single_product_actions', 99);

/**
 * Remove "Out of stock" text on single product pages
 */
function erd_remove_stock_text($html, $product) {
    // Only remove on single product pages
    if (is_product()) {
        return '';
    }
    return $html;
}
add_filter('woocommerce_get_stock_html', 'erd_remove_stock_text', 10, 2);

/**
 * Opening div for product summary
 */
function erd_content_single_product_summary_opening() { ?>
    <div class="flex flex-col md:px-5 lg:px-20 md:pt-16 md:pb-20 md:grid md:grid-cols-12 md:gap-5">
    <?php
}
add_action('woocommerce_before_single_product_summary', 'erd_content_single_product_summary_opening', 1);

/**
 * Closing div for product summary
 */
function erd_content_single_product_summary_closing() { ?>
    </div>
<?php
}
add_action('woocommerce_single_product_summary', 'erd_content_single_product_summary_closing', 99);

/**
 * Product images container
 */
function erd_content_single_product_images() {
    global $product;

    if (!$product) {
        return;
    }

    $product_image_ids = array();

    if (has_post_thumbnail($product->get_id())) {
        $product_image_ids[] = get_post_thumbnail_id($product->get_id());
    }

    $attachment_ids = $product->get_gallery_image_ids();
    if ($attachment_ids) {
        $product_image_ids = array_merge($product_image_ids, $attachment_ids);
    }
?>

    <div class="relative w-full md:col-span-6 self-start">
        <div class="overflow-hidden single-product-slider">
            <div class="swiper-wrapper">
                <?php foreach ($product_image_ids as $image_id) : ?>
                    <div class="swiper-slide">
                        <img class="object-cover w-full aspect-[393/449]" src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')); ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="absolute z-20 flex gap-2 top-4 right-4"><?php echo erd_render_product_labels(); ?></div>
        <div class="absolute inset-0 z-20 hidden cursor-none lg:flex">
            <div data-cursor-animation="trigger" data-cursor-type="slide-prev" class="w-full h-full single-product-slider-prev"></div>
            <div data-cursor-animation="trigger" data-cursor-type="slide-next" class="w-full h-full single-product-slider-next"></div>
        </div>
        <div class="single-product-slider-pagination !absolute !bottom-8 !z-30 flex justify-center gap-1.5"></div>
    </div>

<?php
}
add_action('woocommerce_before_single_product_summary', 'erd_content_single_product_images', 10);


/**
 * Product details opening wrap
 */
function erd_content_single_product_details_opening() { ?>
    <div class="flex flex-col px-5 pt-8 md:pt-0 md:pl-10 lg:pl-15">
    <?php
}
add_action('woocommerce_single_product_summary', 'erd_content_single_product_details_opening', 1);

/**
 * Product details closing wrap
 */
function erd_content_single_product_details_closing() { ?>
    </div>
<?php
}
add_action('woocommerce_single_product_summary', 'erd_content_single_product_details_closing', 99);


/**
 * Product title
 */
function erd_content_single_product_details_title() { ?>
    <h1 class="mb-3 md:mb-4 text-black text-title-l-mobile md:text-title-l"><?php echo get_the_title(); ?></h1>

<?php
}
add_action('woocommerce_single_product_summary', 'erd_content_single_product_details_title', 5);


/**
 * Product price
 */
function erd_content_single_product_details_price() {
    global $product;
?>
    <div class="mb-6 md:mb-8 text-title-xs font-medium"><?php echo $product->get_price_html(); ?></div>

<?php
}
add_action('woocommerce_single_product_summary', 'erd_content_single_product_details_price', 10);


/**
 * Product excerpt
 */
function erd_content_single_product_details_excerpt() {
    global $product;
?>
    <p class="mb-6 md:mb-8 text-black text-body-m-light"><?php echo $product->get_description(); ?></p>


<?php
}
add_action('woocommerce_single_product_summary', 'erd_content_single_product_details_excerpt', 20);



/**
 * Custom variation select dropdowns
 */
function erd_custom_variations_display() {
    global $product;

    if (!$product || $product->get_type() !== 'variable') {
        return;
    }

    // Get attributes and variations
    $attributes = $product->get_variation_attributes();
?>

    <div class="flex flex-col gap-5 md:gap-6 md:mb-8 mb-6">
        <?php foreach ($attributes as $attribute_name => $options) :
            $attribute_slug = sanitize_title($attribute_name);
            $input_name = 'attribute_' . $attribute_slug;

            $input_placeholder = sprintf(__('Select %s', 'erudito'), strtolower(wc_attribute_label($attribute_name)));

            // Format options for our dropdown
            $dropdown_options = [];
            $dropdown_options[''] = $input_placeholder;

            foreach ($options as $option) {
                if (taxonomy_exists($attribute_name)) {
                    // For taxonomy attributes (pa_color, pa_size, etc.)
                    $term = get_term_by('slug', $option, $attribute_name);
                    $display_name = $term ? $term->name : ucfirst($option);
                } else {
                    // For custom product attributes - just capitalize first letter
                    $display_name = ucfirst($option);
                }

                $dropdown_options[$option] = $display_name;
            }

        ?>
            <div data-attribute="<?php echo esc_attr($attribute_slug); ?>">
                <label class="mb-1 text-label-m text-gray5">
                    <?php echo esc_html(wc_attribute_label($attribute_name)); ?>
                </label>

                <?php
                // Render custom dropdown
                erd_render_dropdown([
                    'id' => 'dropdown_' . $attribute_slug,
                    'placeholder' => $input_placeholder,
                    'options' => $dropdown_options,
                    'selected' => '',
                    'class' => '',
                    'attr' => ['data-variation-input' => $input_name],
                    'error' => 'Pasirinkite variantą',
                ]);
                ?>
            </div>
        <?php endforeach; ?>
    </div>

<?php
}
add_action('woocommerce_before_add_to_cart_button', 'erd_custom_variations_display', 5);


/**
 * Product quantity input opening
 */
function erd_before_quantity_input_field() { ?>
    <div data-qty-wrap class="flex gap-1">
        <button data-qty-btn="minus" class="flex items-center justify-center w-12 h-12 p-0 rounded-full cursor-pointer erd_button is-secondary bg-gray">
            <svg class="w-6 h-6 text-black" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12L5 12" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="square" />
            </svg>
        </button>

    <?php
}
add_action('woocommerce_before_quantity_input_field', 'erd_before_quantity_input_field', 10);


/**
 * Product quantity input closing
 */
function erd_after_quantity_input_field() { ?>
        <button data-qty-btn="plus" class="flex items-center justify-center w-12 h-12 p-0 rounded-full cursor-pointer erd_button is-secondary bg-gray">
            <svg class="w-6 h-6 text-black" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12L5 12" stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="square" />
                <path d="M12 5L12 19" stroke="#181B2B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="square" />
            </svg>
        </button>
    </div>

<?php
}
add_action('woocommerce_after_quantity_input_field', 'erd_after_quantity_input_field', 10);


/**
 * Opens a flex container wrapper around quantity and add to cart button
 */
function erd_quantity_and_button_wrapper_open() {
?>
    <div class="flex items-center gap-4 md:gap-6">
    <?php
}
add_action('woocommerce_before_add_to_cart_quantity', 'erd_quantity_and_button_wrapper_open', 10);


/**
 * Closes the flex container wrapper around quantity and add to cart button
 */
function erd_quantity_and_button_wrapper_close() {
    ?>
    </div>
<?php
}
add_action('woocommerce_after_add_to_cart_button', 'erd_quantity_and_button_wrapper_close', 10);


/**
 * Add custom classes to quantity input field
 */
function erd_quantity_input_classes($classes) {
    // Add your custom tailwind classes
    $classes[] = 'w-12';
    $classes[] = 'h-12';
    $classes[] = 'text-center';
    $classes[] = 'text-black';
    $classes[] = 'text-button';

    return $classes;
}
add_filter('woocommerce_quantity_input_classes', 'erd_quantity_input_classes', 10, 1);

/**
 * Custom cursor HTML for single product gallery
 */
function erd_floating_cursor_html() {
    if (!is_product()) {
        return;
    }
?>

    <div data-cursor-animation="cursor" class="fixed top-0 left-0 flex items-center justify-center w-16 h-16 scale-0 rounded-full opacity-0 pointer-events-none bg-yellow z-90">
        <svg data-cursor-animation="icon" class="w-6 h-6 text-black" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 12C10.0531 10.093 11.9966 7.21964 11.9966 4C11.9966 7.21964 13.94 10.093 17 12" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
            <path d="M12 4L12 20" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
        </svg>

    </div>

    <?php
}
add_action('wp_footer', 'erd_floating_cursor_html');


/**
 * Custom accordiong instead of product info tabs
 */
function erd_content_single_product_info_accordion() {
    // Check rows exists.
    if (have_rows('additional_info_accordion')):
        $rows = get_field('additional_info_accordion');
        if ($rows) {
            $first_row = $rows[0];
            $first_row_title = $first_row['title'];
        }
    ?>
        <!-- Need to get the title of the first repeater item for this specific product -->
        <div class="mt-8 md:mt-12" x-data="{ activeTab: '<?php echo esc_attr($first_row_title); ?>' }">

            <?php
            // Loop through rows.
            while (have_rows('additional_info_accordion')) :
                the_row();
                $title = get_sub_field('title');
                $content = get_sub_field('content');
            ?>

                <button
                    class="w-full border-t cursor-pointer border-gray3 md:py-7"
                    @click="activeTab = activeTab === '<?php echo esc_attr($title); ?>' ? '' : '<?php echo esc_attr($title); ?>'"
                    type="button">
                    <div class="font-argent flex justify-start items-center gap-x-4 md:gap-x-6 text-black text-title-s-mobile md:text-title-s">
                        <div class="flex justify-center items-center w-5 h-5 md:w-6 md:h-6 text-black relative">
                            <div class="absolute w-3.5 md:w-4 h-px bg-black"></div>
                            <div x-show="activeTab !== '<?php echo esc_attr($title); ?>'" class="w-px h-3.5 md:h-4 bg-black"></div>
                        </div>
                        <?php echo esc_html($title); ?>
                    </div>
                    <div
                        class="overflow-hidden"
                        x-show="activeTab === '<?php echo esc_attr($title); ?>'"
                        x-collapse>
                        <div class="pt-2 md:pt-4 pl-9 md:pl-12 text-body-m-light text-black text-left"><?php echo $content; ?></div>
                    </div>
                </button>
            <?php
            endwhile; ?>
        </div>
    <?php
    endif;
    ?>

<?php
}
add_action('woocommerce_after_add_to_cart_button', 'erd_content_single_product_info_accordion', 20);


/**
 * Display cross sell products on single product template
 */
function erd_content_single_product_recommended_products() {
    global $product;

    $cross_sell_ids = $product->get_cross_sell_ids();

    if (empty($cross_sell_ids)) {
        return;
    }

    // Limit to 4 products 
    $cross_sell_ids = array_slice($cross_sell_ids, 0, 4);

    $cross_sell_products = array_filter(array_map('wc_get_product', $cross_sell_ids), 'wc_products_array_filter_visible');

    if (empty($cross_sell_products)) {
        return;
    }

?>
    <section class="px-5 md:px-20 overflow-hidden">
        <div class="py-12 lg:pt-20 lg:pb-26 border-t border-gray3 flex flex-col gap-y-8 md:gap-y-12">
            <h2 class="text-title-l-mobile md:text-title-l max-w-[32rem] text-black"><?php echo esc_html__('Students\' favourite choices', 'erudito'); ?></h2>
            <div class="single_product_crossell-slider md:hidden">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($cross_sell_products as $cross_sell_product) :
                        $post_object = get_post($cross_sell_product->get_id());
                        setup_postdata($GLOBALS['post'] = &$post_object);
                    ?>
                        <div class="swiper-slide">
                            <?php
                            wc_get_template_part('content', 'product'); ?>
                        </div>
                    <?php
                    endforeach;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <div class="hidden md:grid grid-cols-4 gap-12">
                <?php
                foreach ($cross_sell_products as $cross_sell_product) :
                    $post_object = get_post($cross_sell_product->get_id());
                    setup_postdata($GLOBALS['post'] = &$post_object);
                ?>
                    <div class="swiper-slide">
                        <?php
                        wc_get_template_part('content', 'product'); ?>
                    </div>
                <?php
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
<?php
}
add_action('woocommerce_after_single_product_summary', 'erd_content_single_product_recommended_products', 10);
