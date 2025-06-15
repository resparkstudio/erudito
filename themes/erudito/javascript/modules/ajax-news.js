/**
 * AJAX remove from cart functionality
 */

const $ = window.jQuery;
const { nonce, ajax_url } = window.erdAjaxData || {};

export function ajaxFilterNews() {
	// Remove item
	$(document).on('click', '.news-filter-button', function (e) {
		e.preventDefault();

		const button = $(this);
		const value = button.val();

		filterNews(value);
	});

	function filterNews(category) {
		if (!category) {
			console.error('Category not found');
			return;
		}

		$.post(ajax_url, {
			action: 'erd_filter_news',
			category: category,
			nonce: nonce,
		})
			.done(function (response) {
				if (response.success) {
					// Update news section with filtered results
					$('.news-archive').html(response.data.html);
				}
			})
			.fail(function (xhr, status, error) {
				console.error('Filter news AJAX error:', status, error);
			});
	}
}
