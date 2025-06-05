/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

import { initProductFilters } from './modules/ajax-product-filters';
import { notificationManager } from './modules/notification-manager';
import './modules/custom-dropdown';
import { erdFloatingCartCounter } from './modules/ajax-cart-counter';
import { customCursorAnimation } from './modules/cursor';
import { productQtyButtons } from './modules/product-qty-input';
import { productVariationDropdown } from './modules/variation-dropdowns';
import { singleAjaxAddToCart } from './modules/ajax-add-to-cart';
import { initAnimations } from './modules/animations';
import { initSwiper } from './modules/swiper';

/**
 * Init alpine JS
 */
window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.start();

const init = () => {
	initSwiper();
	initProductFilters();
	erdFloatingCartCounter();
	customCursorAnimation();
	productQtyButtons();
	productVariationDropdown();
	singleAjaxAddToCart();
	initAnimations();
};

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', () => {
	// Initialize the script
	init();
});
