/**
 * Custom floating cursor code
 */
import { gsap } from 'gsap';

export function customCursorAnimation() {
	const cursor = document.querySelector('[data-cursor-animation="cursor"]');
	if (!cursor) return;

	const cursorTriggers = document.querySelectorAll(
		'[data-cursor-animation="trigger"]'
	);
	const cursorIcon = document.querySelector('[data-cursor-animation="icon"]');

	// Set initial state of the cursor
	gsap.set(cursor, { xPercent: -50, yPercent: -50, autoAlpha: 0 });

	let xTo = gsap.quickTo(cursor, 'x', { duration: 0.3, ease: 'power3' }),
		yTo = gsap.quickTo(cursor, 'y', { duration: 0.3, ease: 'power3' });

	window.addEventListener('pointermove', (e) => {
		xTo(e.clientX);
		yTo(e.clientY);
	});

	// Cursor reveal timeline
	let showTl = gsap.timeline({ paused: true });
	showTl
		.set(cursor, { autoAlpha: 1 })
		.to(cursor, { scale: 1, duration: 0.4, ease: 'power4.inOut' });

	// Cursor click animation (check if cursor is visible)
	const cursorClick = () => {
		if (gsap.getProperty(cursor, 'autoAlpha') === 1) {
			gsap.to(cursor, {
				scale: 0.85,
				duration: 0.15,
				ease: 'power2.inOut',
			});
		}
	};

	// Cursor release animation
	const cursorRelease = () => {
		if (gsap.getProperty(cursor, 'autoAlpha') === 1) {
			gsap.to(cursor, { scale: 1, duration: 0.15, ease: 'power2.inOut' });
		}
	};

	document.addEventListener('mousedown', cursorClick);
	document.addEventListener('mouseup', cursorRelease);

	// Show cursor on hover
	cursorTriggers.forEach((trigger) => {
		const cursorType = trigger.getAttribute('data-cursor-type');

		trigger.addEventListener('mouseover', () => {
			// Set cursor icon rotation
			if (cursorType === 'slide-prev') {
				gsap.set(cursorIcon, { rotation: -90 });
			} else if (cursorType === 'slide-next') {
				gsap.set(cursorIcon, { rotation: 90 });
			}

			// Play the reveal timeline
			showTl.play();
		});

		trigger.addEventListener('mouseout', () => {
			showTl.reverse();
		});
	});

	//Hide cursor on gallery expand button hover
	const galleryExpandButtons = document.querySelectorAll(
		'.gallery-expand-button'
	);

	if (galleryExpandButtons) {
		galleryExpandButtons.forEach((button) => {
			button.addEventListener('mouseover', () => {
				console.log('Gallery expand button hovered');
				showTl.reverse();
			});
		});
	}
}
