/**
 * AJAX quantity updates for cart page
 */

import { notificationManager } from "./notification-manager";

const $ = window.jQuery;
const { nonce, messages } = window.erdAjaxData || {};

export function ajaxCartQuantity() {
  // Only run on cart page
  if (!$("body").hasClass("woocommerce-cart")) return;

  const cartForm = $(".woocommerce-cart-form");
  if (!cartForm.length) return;

  // Listen for quantity changes - using parent container data attribute
  $(document).on(
    "change",
    '.woocommerce-cart-form .product-quantity input[type="number"]',
    function () {
      const input = $(this);
      const cartItemKey = input
        .closest(".product-quantity")
        .data("cart-item-key");
      const newQuantity = parseInt(input.val()) || 0;

      updateQuantity(cartItemKey, newQuantity, input);
    },
  );

  function updateQuantity(cartItemKey, quantity, inputElement) {
    if (!cartItemKey) {
      console.error("Cart item key not found");
      return;
    }

    // Store original value for error recovery
    const originalValue = inputElement.data("original-value") || 1;
    inputElement.data("original-value", inputElement.val());

    $.post(wc_cart_params.ajax_url, {
      action: "erd_update_cart_quantity",
      cart_item_key: cartItemKey,
      quantity: quantity,
      nonce: nonce,
    })
      .done(function (response) {
        if (response.success) {
          // Trigger fragment refresh - updates your .cart_totals
          $(document.body).trigger("wc_fragment_refresh");
        } else {
          // Revert to original value
          inputElement.val(originalValue);
          showError(
            response.data.message || messages.error_generic || "Update failed",
          );
        }
      })
      .fail(function (xhr, status, error) {
        console.error("Quantity update AJAX error:", status, error);
        inputElement.val(originalValue);
        showError(
          messages.error_generic || "Connection error. Please try again.",
        );
      })
      .always(function () {
        inputElement.prop("disabled", false);
      });
  }

  function showError(message) {
    // You can integrate this with your notification system
    notificationManager.show(message, "error");
    console.error("Cart quantity error:", message);
  }

  // Store original values when page loads
  $('.woocommerce-cart-form .product-quantity input[type="number"]').each(
    function () {
      $(this).data("original-value", $(this).val());
    },
  );

  // Update original values after fragments refresh
  $(document).on("wc_fragments_refreshed", function () {
    $('.woocommerce-cart-form .product-quantity input[type="number"]').each(
      function () {
        $(this).data("original-value", $(this).val());
      },
    );
  });
}
