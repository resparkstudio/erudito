<?php

/**
 * Product quantity input opening
 */
function erd_before_quantity_input_field() {
    $product_size_classes = "w-12 h-12";
    $cart_size_classes = "w-10 h-10 md:w-12 md:h-12"
?>
    <div data-qty-wrap class="flex items-center gap-1">
        <button data-qty-btn="minus" class="flex items-center justify-center p-0 rounded-full cursor-pointer erd_button is-secondary bg-gray <?php echo is_cart() ? $cart_size_classes : $product_size_classes; ?>">
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
function erd_after_quantity_input_field() {
    $product_size_classes = "w-12 h-12";
    $cart_size_classes = "w-10 h-10 md:w-12 md:h-12"
    ?>
        <button data-qty-btn="plus" class="flex items-center justify-center p-0 rounded-full cursor-pointer erd_button is-secondary bg-gray <?php echo is_cart() ? $cart_size_classes : $product_size_classes; ?>">
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
 * Add custom classes to quantity input field
 */
function erd_quantity_input_classes($classes) {

    // Add your custom tailwind classes
    $classes[] = 'w-12';
    $classes[] = is_cart() ? 'h-10' : 'h-12';
    $classes[] = 'text-center';
    $classes[] = 'text-black';
    $classes[] = 'text-button';

    return $classes;
}
add_filter('woocommerce_quantity_input_classes', 'erd_quantity_input_classes', 10, 1);
