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

import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

const initSwiper = () => {
	new Swiper('.hero-slider', {
		slidesPerView: 1,
		navigation: {
			nextEl: '.hero-slider-next',
			prevEl: '.hero-slider-prev',
		},
		pagination: {
			el: '.hero-slider-pagination',
			clickable: true,
		},
		modules: [Navigation, Pagination],
	});
	new Swiper('.testimonials-slider', {
		slidesPerView: 1,
		navigation: {
			nextEl: '.testimonials-slider-next',
			prevEl: '.testimonials-slider-prev',
		},
		pagination: {
			el: '.testimonials-slider-pagination',
			clickable: true,
		},
		modules: [Navigation, Pagination],
	});

	new Swiper('.news-slider', {
		slidesPerView: 1.1,
		spaceBetween: 16,
		breakpoints: {
			1024: {
				slidesPerView: 3,
				spaceBetween: 40,
			},
		},
	});

	new Swiper('.events-slider', {
		slidesPerView: 1,
		breakpoints: {
			1024: {
				slidesPerView: 2,
				spaceBetween: 40,
			},
		},
	});

	new Swiper('.gallery-slider', {
		slidesPerView: 'auto',
		spaceBetween: 8,
		breakpoints: {
			1024: {
				spaceBetween: 16,
			},
		},
	});

	new Swiper('.tab-slider', {
		slidesPerView: 'auto',
		breakpoints: {
			1024: {
				spaceBetween: 2,
			},
		},
	});

	new Swiper('.eureka-slider', {
		slidesPerView: 1,
		navigation: {
			nextEl: '.eureka-slider-next',
			prevEl: '.eureka-slider-prev',
		},
		modules: [Navigation],
	});

	new Swiper('.departments-slider', {
		slidesPerView: 1.1,
		spaceBetween: 16,
	});
};

const init = () => {
	// Initialize Swiper
	initSwiper();

	// Add any other initialization code here
};

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', () => {
	// Initialize the script
	init();
});
