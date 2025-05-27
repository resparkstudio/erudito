/**
 * Single product AJAX add to cart functionality
 */

export function singleAjaxAddToCart() {
	const cartForms = document.querySelectorAll('form.cart');
	if (!cartForms.length) return;

	// Access the global variable created by wp_localize_script
	const { ajax_url, nonce } = window.erdAjaxData || {};

	cartForms.forEach((form) => {
		const addToCartButton = form.querySelector(
			'.single_add_to_cart_button'
		);

		addToCartButton.addEventListener('click', (e) => {
			if (
				addToCartButton.classList.contains(
					'wc-variation-selection-needed'
				)
			) {
				// 1. Prevent default woo alert
				e.preventDefault();
				e.stopImmediatePropagation();

				// 2. Get all empty inputs
				const variationInputs = form.querySelectorAll(
					'select[name^="attribute_"]'
				);
				const emptyInputs = [];
				variationInputs.forEach((input) => {
					if (!input.value || input.value === '') {
						const emptyAttrName = input.dataset.attribute_name;
						const customVariationWrap = form.querySelector(
							`[data-variation-input="${emptyAttrName}"]`
						);

						const dropdownBtn =
							customVariationWrap.querySelector('button');
						dropdownBtn.classList.add('border-red2');
					}
				});

				// 3. Display error messages on them

				// Note: remove errors on successful add to cart later
			}
		});

		form.addEventListener('submit', function (e) {
			e.preventDefault();

			const productIdInput = form.querySelector('[name=add-to-cart]');
			const quantityInput = form.querySelector('input.qty');
			const variationIdInput = form.querySelector(
				'input[name=variation_id]'
			);

			const formData = new FormData();
			formData.append('action', 'erd_single_ajax_add_to_cart');
			formData.append(
				'product_id',
				productIdInput ? productIdInput.value : ''
			);
			formData.append(
				'quantity',
				quantityInput ? quantityInput.value : '1'
			);
			formData.append(
				'variation_id',
				variationIdInput ? variationIdInput.value : '0'
			);
			formData.append('nonce', nonce);

			// AJAX call
			fetch(ajax_url, {
				method: 'POST',
				body: formData,
			})
				.then((response) => response.json())
				.then((response) => {
					if (response.error && response.product_url) {
						window.location = response.product_url;
					} else {
						// Update fragments, including mini cart
						if (response.fragments) {
							Object.entries(response.fragments).forEach(
								([key, value]) => {
									const elements =
										document.querySelectorAll(key);
									elements.forEach((element) => {
										element.outerHTML = value;
									});
								}
							);

							// Trigger WooCommerce's fragments refreshed event
							document.body.dispatchEvent(
								new CustomEvent('wc_fragments_refreshed')
							);
						}

						// Trigger WooCommerce's added_to_cart event
						document.body.dispatchEvent(
							new CustomEvent('added_to_cart', {
								detail: {
									fragments: response.fragments,
									cart_hash: response.cart_hash,
								},
							})
						);
					}
				})
				.catch((error) => {
					console.error('Error:', error);
				});
		});
	});
}
