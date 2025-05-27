<?php

/**
 * Floating cart button with AJAX counter
 */


function erd_render_floating_cart_button() {
    // Always hide on admin, cart, and checkout pages
    if (is_admin() || is_cart() || is_checkout()) {
        return;
    }

    $cart_count = WC()->cart->get_cart_contents_count();
    if (!((is_shop() || is_product_category() || is_product_tag() || is_product()) || ($cart_count > 0))) {
        return;
    }

    $cart_url = wc_get_cart_url();
?>
    <a href="<?php echo esc_url($cart_url); ?>"
        class="fixed right-0 z-50 flex items-center justify-center gap-3 px-3 py-2 text-white origin-bottom-right -rotate-90 lg:py-3 lg:px-4 lg:gap-4 bg-blue2 rounded-t-xl top-40"
        aria-label="<?php esc_attr_e('View cart', 'eruditus'); ?>">
        <div class="flex items-center gap-1 lg:gap-2">
            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 8L19 8L18.1982 18.0793C18.1569 18.5992 17.7229 19 17.2014 19H6.79861C6.27708 19 5.84312 18.5992 5.80176 18.0793L5 8Z" stroke="white" />
                <path d="M9 10.5L9 6C9 4.34315 10.3431 3 12 3V3C13.6569 3 15 4.34315 15 6L15 10.5" stroke="white" />
            </svg>
            <span class="text-white text-body-s-medium lg:text-body-m-medium"><?php echo esc_html__('View cart', 'eruditus'); ?></span>
        </div>
        <span data-floating-cart="counter" class="flex items-center justify-center w-5 h-5 text-white rounded-full bg-violet text-label-s">
            <?php echo $cart_count; ?>
        </span>
    </a>
<?php
}
add_action('wp_footer', 'erd_render_floating_cart_button');
