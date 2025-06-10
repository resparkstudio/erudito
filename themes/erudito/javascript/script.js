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
import './modules/component-dropdown';
import { erdFloatingCartCounter } from './modules/ajax-cart-counter';
import { customCursorAnimation } from './modules/cursor';
import { productQtyButtons } from './modules/product-qty-input';
import { productVariationDropdown } from './modules/product-variation-dropdowns';
import { singleAjaxAddToCart } from './modules/ajax-add-to-cart';
import { initAnimations } from './modules/animations';
import { productStockNotificationForm } from './modules/product-notify-form';
import { productMainPriceUpdater } from './modules/product-price-updater';
import { ajaxCartCouponForm } from './modules/ajax-cart-coupon';
import { ajaxCartQuantity } from './modules/ajax-cart-qty';
import { ajaxRemoveCart } from './modules/ajax-cart-remove';
import { initSwiper } from './modules/swiper';
/**
 * Init alpine JS
 */
window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.start();

const init = () => {
	// Initialize Swiper
	initSwiper();
	initProductFilters();
	erdFloatingCartCounter();
	customCursorAnimation();
	productQtyButtons();
	productVariationDropdown();
	singleAjaxAddToCart();
	initAnimations();
	productStockNotificationForm();
	productMainPriceUpdater();
	ajaxCartCouponForm();
	ajaxCartQuantity();
	ajaxRemoveCart();
};

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', () => {
	// Initialize the script
	init();
});
