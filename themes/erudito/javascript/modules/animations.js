import { gsap } from 'gsap';

import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const heroAnimation = () => {
	gsap.fromTo(
		'.hero-image-left',
		{ rotate: -10 },
		{
			rotate: 0,
			delay: 0.5,
			duration: 3,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.hero-image-left',
				start: 'top 80%',
				end: 'bottom 20%',
				toggleActions: 'play none none reverse',
			},
		}
	);

	gsap.fromTo(
		'.hero-image-right',
		{ rotate: 0 },
		{
			rotate: -10,
			delay: 0.5,
			duration: 3,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.hero-image-right',
				start: 'top 80%',
				end: 'bottom 20%',
				toggleActions: 'play none none reverse',
			},
		}
	);

	gsap.fromTo(
		'.hero-text-content',
		{ opacity: 0, y: 50 },
		{
			opacity: 1,
			y: 0,
			delay: 1.5,
			duration: 1,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.hero-text-content',
				start: 'top 80%',
				end: 'bottom 20%',
				toggleActions: 'play none none reverse',
			},
			stagger: {
				amount: 0.2,
				each: 0.1,
			},
		}
	);
};

const galleryAnimation = () => {
	const gallerySwiper = document.querySelector('.gallery-slider');

	if (!gallerySwiper) return;

	gallerySwiper.addEventListener('mousedown', () => {
		const galleryImages = gallerySwiper.querySelectorAll('.gallery-image');
		galleryImages.forEach((image) => {
			gsap.to(image, { scale: 0.9, duration: 0.3 });
		});
	});
	gallerySwiper.addEventListener('mouseup', () => {
		const galleryImages = gallerySwiper.querySelectorAll('.gallery-image');
		galleryImages.forEach((image) => {
			gsap.to(image, { scale: 1, duration: 0.3 });
		});
	});
	gallerySwiper.addEventListener('mouseleave', () => {
		const galleryImages = gallerySwiper.querySelectorAll('.gallery-image');
		galleryImages.forEach((image) => {
			gsap.to(image, { scale: 1, duration: 0.3 });
		});
	});
};

const careersAnimation = () => {
	const careerCardsOdd = document.querySelectorAll('.career-card-odd');
	const careerCardsEven = document.querySelectorAll('.career-card-even');

	if (!careerCardsOdd.length || !careerCardsEven.length) return;

	careerCardsEven.forEach((element) => {
		gsap.fromTo(
			element,
			{ rotate: 0 },
			{
				rotate: -8,
				duration: 1,
				ease: 'power2.out',
				scrollTrigger: {
					trigger: element,
					start: 'top 80%',
					end: 'bottom 20%',
					toggleActions: 'play none none',
				},
			}
		);
	});

	careerCardsOdd.forEach((element) => {
		gsap.fromTo(
			element,
			{ rotate: 0 },
			{
				rotate: 8,
				duration: 1,
				ease: 'power2.out',
				scrollTrigger: {
					trigger: element,
					start: 'top 80%',
					end: 'bottom 20%',
					toggleActions: 'play none none',
				},
			}
		);
	});
};

const aboutUsAnimation = () => {
	const svgMask = document.querySelector('.svg-mask');

	if (!svgMask) return;

	gsap.fromTo(
		svgMask,
		{ rotate: 0, width: '30%' },
		{
			rotate: 20,
			width: '200%',
			scale: 2,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: svgMask,
				start: 'top 80%',
				end: '+=3000',
				scrub: true,
			},
		}
	);
};

export const initAnimations = () => {
	heroAnimation();
	galleryAnimation();
	careersAnimation();
	aboutUsAnimation();
};
