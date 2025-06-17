/**
 * ERD Ajax filters and pagination
 */

import { productSkeletonLoader } from './product-skeleton-loader';

// Access the global variable created by wp_localize_script
const { ajax_url, nonce, shop_url, products_per_page } =
	window.erdAjaxData || {};

export function initProductFilters() {
	// Make sure we have the required data from WordPress
	if (!ajax_url || !nonce) {
		return;
	}

	// Get all category filter links
	const filterLinks = document.querySelectorAll('[data-category-filter-btn]');
	const productContainer = document.getElementById('products-grid');

	// Get archive container for scroll to top functionality
	const archiveContainer = document.getElementById('archive-content');

	document.addEventListener('erd-dropdown-change', (e) => {
		if (e.detail.dropdownId !== 'archive-order-dropdown') {
			return;
		}
		const orderby = e.detail.value;
		loadProducts(currentCategory, currentCategoryId, 1, orderby);
	});

	if (!filterLinks.length || !productContainer) return;

	// Track current state - Initialize from page state
	let currentCategory = 'all';
	let currentCategoryId = 0;
	let currentOrder = 'menu_order';

	// Initialize state from current page
	function initializeState() {
		// Method 1: Read from URL
		const urlParams = new URLSearchParams(window.location.search);
		const categoryFromUrl = urlParams.get('product_cat');
		const orderbyFromUrl = urlParams.get('orderby');

		if (orderbyFromUrl) {
			currentOrder = orderbyFromUrl;

			// Update the dropdown to match URL
			const orderDropdown = document.getElementById(
				'archive-order-dropdown'
			);
			if (orderDropdown && orderDropdown.alpineData) {
				// This might not work depending on your Alpine setup, alternative below
				orderDropdown.alpineData.selectOption(
					orderbyFromUrl,
					getOrderbyLabel(orderbyFromUrl)
				);
			}
		}

		if (categoryFromUrl) {
			// Find the active filter button
			const activeFilter = document.querySelector(
				`[data-category="${categoryFromUrl}"]`
			);
			if (activeFilter) {
				currentCategory = categoryFromUrl;
				currentCategoryId =
					parseInt(activeFilter.dataset.categoryId) || 0;
			}
		}

		// Method 2: Read from active filter (fallback)
		const activeFilter = document.querySelector(
			'[data-category-filter-btn].active'
		);
		if (activeFilter && currentCategory === 'all') {
			currentCategory = activeFilter.dataset.category;
			currentCategoryId = parseInt(activeFilter.dataset.categoryId) || 0;
		}
	}

	// Function to make AJAX requests
	function loadProducts(
		category,
		categoryId,
		page = 1,
		orderby = 'menu_order'
	) {
		// Replace products with skeletons
		productContainer.innerHTML = productSkeletonLoader(products_per_page);
		// Update visual state for filters
		if (category !== currentCategory) {
			filterLinks.forEach((el) => {
				el.classList.remove('active', 'bg-[#394173]');
				el.classList.add('opacity-50');
			});

			const activeFilter = document.querySelector(
				`[data-category="${category}"]`
			);
			if (activeFilter) {
				activeFilter.classList.add('active', 'bg-[#394173]');
				activeFilter.classList.remove('opacity-50');
			}
		}

		currentCategory = category;
		currentCategoryId = categoryId;
		currentOrder = orderby;

		// Prepare form data
		const formData = new FormData();
		formData.append('action', 'erd_filter_products');
		formData.append('category', category);
		formData.append('category_id', categoryId);
		formData.append('page', page);
		formData.append('orderby', orderby);
		formData.append('nonce', nonce);

		// Make request
		fetch(ajax_url, {
			method: 'POST',
			body: formData,
			credentials: 'same-origin',
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					// Scroll to container top
					archiveContainer.scrollIntoView({
						behavior: 'smooth',
						block: 'start',
					});

					// Update products
					productContainer.innerHTML = data.data.products;

					// Update pagination
					const paginationContainer = document.querySelector(
						'nav[aria-label="Product pagination"]'
					);
					if (paginationContainer) {
						// Pagination exists, replace it
						paginationContainer.outerHTML = data.data.pagination;
					} else {
						// Pagination doesn't exist, insert it after the product container
						productContainer.insertAdjacentHTML(
							'afterend',
							data.data.pagination
						);
					}

					// Re-attach pagination event listeners
					attachPaginationListeners();
					// Update URL
					updateURL(category, page, orderby);
				} else {
					productContainer.innerHTML = data.data;
				}
			})
			.catch((error) => {
				console.error('Error:', error);
			});
	}

	// Function to attach pagination listeners
	function attachPaginationListeners() {
		// Handle numbered pagination links
		const paginationLinks = document.querySelectorAll(
			'nav[aria-label="Product pagination"] a[data-page]'
		);

		// Handle prev/next buttons
		const prevNextButtons = document.querySelectorAll(
			'nav[aria-label="Product pagination"] a.erd_button[data-page]'
		);

		paginationLinks.forEach((link) => {
			link.removeEventListener('click', handlePaginationClick);
			link.addEventListener('click', handlePaginationClick);
		});

		// Add event listeners to prev/next buttons too
		prevNextButtons.forEach((button) => {
			button.removeEventListener('click', handlePaginationClick);
			button.addEventListener('click', handlePaginationClick);
		});
	}

	// Pagination click handler
	function handlePaginationClick(e) {
		e.preventDefault();
		const page = parseInt(this.dataset.page);
		loadProducts(currentCategory, currentCategoryId, page, currentOrder);
	}

	// URL update function
	function updateURL(category, page, orderby) {
		let url = shop_url;
		const params = new URLSearchParams();

		if (category !== 'all') {
			params.set('product_cat', category);
		}
		if (page > 1) {
			params.set('paged', page);
		}

		if (orderby !== 'menu_order') {
			params.set('orderby', orderby);
		}

		if (params.toString()) {
			url += '?' + params.toString();
		}

		history.pushState(null, '', url);
	}

	// Initialize filter links event listeners
	filterLinks.forEach((link) => {
		link.addEventListener('click', function (e) {
			e.preventDefault();
			const category = this.dataset.category;
			const categoryId = this.dataset.categoryId;
			loadProducts(category, categoryId, 1, currentOrder); // Start from page 1 for new category
		});
	});

	// Initialize state from current page
	initializeState();

	// Initial pagination listener attachment
	attachPaginationListeners();
}
