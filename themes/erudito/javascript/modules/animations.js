import { gsap } from 'gsap';

import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { Draggable } from 'gsap/Draggable';

gsap.registerPlugin(ScrollTrigger, Draggable);

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
		{ maskSize: '30%' },
		{
			maskSize: '200%',
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

const shapesAnimation = () => {
	const shapes = document.querySelector('.gallery-shapes');

	if (!shapes) return;

	gsap.fromTo(
		'.shapes-text',
		{ opacity: 0, y: 50 },
		{
			opacity: 1,
			y: 0,
			delay: 1.5,
			duration: 1,
			ease: 'power2.out',
			stagger: {
				amount: 0.2,
				each: 0.1,
			},
		}
	);

	gsap.fromTo(
		shapes,
		{ y: 150 },
		{
			y: 0,
			duration: 1,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: shapes,
				start: 'top 80%',
				end: 'bottom 20%',
				toggleActions: 'play none none',
			},
		}
	);

	gsap.fromTo(
		'.div1',
		{ rotate: 0 },
		{
			rotate: 5,
			duration: 1,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.div1',
				start: 'top 40%',
				end: 'bottom 20%',
				toggleActions: 'play none none',
			},
			stagger: {
				amount: 0.2,
				each: 0.1,
			},
		}
	);

	gsap.fromTo(
		'.div2',
		{ rotate: 0 },
		{
			rotate: 5,
			duration: 1,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.div2',
				start: 'top 60%',
				end: 'bottom 20%',
				toggleActions: 'play none none',
			},
			stagger: {
				amount: 0.2,
				each: 0.1,
			},
		}
	);
	gsap.fromTo(
		'.div3',
		{ rotate: 0 },
		{
			rotate: -5,
			duration: 1,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.div3',
				start: 'top 40%',
				end: 'bottom 20%',
				toggleActions: 'play none none',
			},
			stagger: {
				amount: 0.2,
				each: 0.1,
			},
		}
	);
	gsap.fromTo(
		'.div4',
		{ rotate: 0 },
		{
			rotate: -5,
			duration: 1,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.div4',
				start: 'top 40%',
				end: 'bottom 20%',
				toggleActions: 'play none none',
			},
			stagger: {
				amount: 0.2,
				each: 0.1,
			},
		}
	);

	gsap.fromTo(
		'.div5',
		{ rotate: 0 },
		{
			rotate: 5,
			duration: 1,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.div5',
				start: 'top 40%',
				end: 'bottom 20%',
				toggleActions: 'play none none',
			},
			stagger: {
				amount: 0.2,
				each: 0.1,
			},
		}
	);
	gsap.fromTo(
		'.div6',
		{ rotate: 0 },
		{
			rotate: 5,
			duration: 1,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.div6',
				start: 'top 60%',
				end: 'bottom 20%',
				toggleActions: 'play none none',
			},
			stagger: {
				amount: 0.2,
				each: 0.1,
			},
		}
	);
	gsap.fromTo(
		'.div7',
		{ y: 0 },
		{
			y: -50,
			duration: 1,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.div7',
				start: 'top 60%',
				end: 'bottom 20%',
				toggleActions: 'play none none',
			},
			stagger: {
				amount: 0.2,
				each: 0.1,
			},
		}
	);
	gsap.fromTo(
		'.div8',
		{ rotate: 0 },
		{
			rotate: -5,
			duration: 1,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: '.div8',
				start: 'top 60%',
				end: 'bottom 20%',
				toggleActions: 'play none none',
			},
			stagger: {
				amount: 0.2,
				each: 0.1,
			},
		}
	);
};

export const initAnimations = () => {
	heroAnimation();
	careersAnimation();
	aboutUsAnimation();
	shapesAnimation();
};
