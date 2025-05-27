/**
 * Code for "-" and "+" product qty input buttons
 */

export function productQtyButtons() {
	const qtyWraps = document.querySelectorAll('[data-qty-wrap]');
	if (!qtyWraps.length) return;

	function updateButtonStates(qtyInput, minusBtn, plusBtn) {
		const min = parseInt(qtyInput.min) || 0;
		const max = parseInt(qtyInput.max) || Infinity;
		const currentValue = parseInt(qtyInput.value) || min;

		// Update minus button
		if (currentValue <= min) {
			minusBtn.style.pointerEvents = 'none';
			minusBtn.setAttribute('disabled', 'true'); // Better for accessibility
		} else {
			minusBtn.style.pointerEvents = 'auto';
			minusBtn.removeAttribute('disabled');
		}

		// Update plus button
		if (currentValue >= max) {
			plusBtn.style.pointerEvents = 'none';
			plusBtn.setAttribute('disabled', 'true');
		} else {
			plusBtn.style.pointerEvents = 'auto';
			plusBtn.removeAttribute('disabled');
		}
	}

	function adjustQty(btn, qtyInput, minusBtn, plusBtn) {
		const type = btn.dataset.qtyBtn;
		const min = parseInt(qtyInput.min) || 0;
		const max = parseInt(qtyInput.max) || Infinity;
		const step = parseInt(qtyInput.step) || 1;
		let currentValue = parseInt(qtyInput.value) || min;

		if (type === 'minus' && currentValue > min) {
			qtyInput.value = currentValue - step;
		} else if (type === 'plus' && currentValue < max) {
			qtyInput.value = currentValue + step;
		}

		// Update button states after value change
		updateButtonStates(qtyInput, minusBtn, plusBtn);

		// Trigger events for form validation and WooCommerce
		qtyInput.dispatchEvent(new Event('input', { bubbles: true }));
		qtyInput.dispatchEvent(new Event('change', { bubbles: true }));
	}

	qtyWraps.forEach((wrap) => {
		const qtyInput = wrap.querySelector('input[type="number"]');
		const minusBtn = wrap.querySelector('[data-qty-btn="minus"]');
		const plusBtn = wrap.querySelector('[data-qty-btn="plus"]');

		if (!qtyInput || !minusBtn || !plusBtn) return; // Safety check

		// Set initial button states
		updateButtonStates(qtyInput, minusBtn, plusBtn);

		// Handle manual input changes
		qtyInput.addEventListener('input', () => {
			updateButtonStates(qtyInput, minusBtn, plusBtn);
		});

		// Handle button clicks
		[minusBtn, plusBtn].forEach((btn) => {
			btn.addEventListener('click', (e) => {
				e.preventDefault();
				adjustQty(btn, qtyInput, minusBtn, plusBtn);
			});
		});
	});
}
