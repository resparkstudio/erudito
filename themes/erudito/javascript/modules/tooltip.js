import tippy from 'tippy.js';

export const initTooltip = () => {
	const tooltipElements = document.querySelectorAll('[data-tooltip]');
	tooltipElements.forEach((element) => {
		const tooltipText = element.getAttribute('data-tooltip');
		if (tooltipText) {
			tippy(element, {
				content: tooltipText,
				placement: 'top',
				arrow: true,
				animation: 'fade',
				theme: 'erd',
			});
		}
	});
};
