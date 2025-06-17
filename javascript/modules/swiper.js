import Swiper from 'swiper';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';

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
		autoplay: {
			delay: 4000,
			disableOnInteraction: false,
		},
		modules: [Navigation, Pagination, Autoplay],
	});
	new Swiper('.testimonials-slider', {
		autoplay: true,
		slidesPerView: 1,
		navigation: {
			nextEl: '.testimonials-slider-next',
			prevEl: '.testimonials-slider-prev',
		},
		pagination: {
			el: '.testimonials-slider-pagination',
			clickable: true,
		},
		modules: [Navigation, Pagination, Autoplay],
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
		loop: true,
		speed: 6000,
		autoplay: {
			disableOnInteraction: true,
		},
		on: {
			touchStart: function () {
				this.slides.forEach((slide) => {
					slide.style.transition = 'transform 0.2s';
					slide.style.transform = 'scale(0.95)';
				});
			},
			touchEnd: function () {
				this.slides.forEach((slide) => {
					slide.style.transition = 'transform 0.2s';
					slide.style.transform = '';
				});
			},
		},
		modules: [Autoplay],
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
			prevEl: '.eureka-slider-prev',
			nextEl: '.eureka-slider-next',
		},
		pagination: {
			el: '.eureka-slider-pagination',
			clickable: true,
		},
		modules: [Navigation, Pagination],
	});

	new Swiper('.departments-slider', {
		slidesPerView: 1.1,
		spaceBetween: 16,
	});

	new Swiper('.single-product-slider', {
		slidesPerView: 1,
		spaceBetween: 0,
		navigation: {
			nextEl: '.single-product-slider-next',
			prevEl: '.single-product-slider-prev',
		},
		pagination: {
			el: '.single-product-slider-pagination',
			clickable: true,
		},

		modules: [Navigation, Pagination],
	});

	new Swiper('.single_product_crossell-slider', {
		slidesPerView: 1.6,
		spaceBetween: 16,
	});

	new Swiper('.content-slider', {
		slidesPerView: 1,
		navigation: {
			nextEl: '.content-slider-next',
			prevEl: '.content-slider-prev',
		},
		pagination: {
			el: '.content-slider-pagination',
			clickable: true,
		},
		modules: [Navigation, Pagination],
	});

	new Swiper('.school-facilities-slider', {
		slidesPerView: 1,
		navigation: {
			nextEl: '.single-product-slider-next',
			prevEl: '.single-product-slider-prev',
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		modules: [Navigation, Pagination],
	});

	new Swiper('.modal-gallery-slider', {
		slidesPerView: 1,
		loop: true,
		pagination: {
			el: '.modal-gallery-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.modal-gallery-next',
			prevEl: '.modal-gallery-prev',
		},
		modules: [Navigation, Pagination],
	});
};

export { initSwiper };
