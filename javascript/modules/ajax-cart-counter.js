/**
 * ERD AJAX floating cart counter
 */

export function erdFloatingCartCounter() {
	// Access the global variable created by wp_localize_script
	const { ajax_url, nonce } = window.erdAjaxData || {};

	// Add event listeners to WooCommerce events
	jQuery(document.body).on(
		'added_to_cart removed_from_cart',
		(event, fragments, hash, button) => {
			updateProductCounter();
		}
	);

	function updateProductCounter() {
		fetch(ajax_url, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: new URLSearchParams({
				action: 'erd_get_product_count',
				nonce: nonce,
			}),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					const countElement = document.querySelector(
						'[data-floating-cart="counter"]'
					);
					if (countElement) {
						countElement.textContent = data.data;
					}
				}
			});
	}
}
