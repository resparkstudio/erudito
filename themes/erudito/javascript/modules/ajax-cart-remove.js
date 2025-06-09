/**
 * AJAX remove from cart functionality
 */
import { notificationManager } from "./notification-manager";

const $ = window.jQuery;
const { nonce, messages = {} } = window.erdAjaxData || {};

export function ajaxRemoveCart() {
  // Only run on cart page
  if (!$("body").hasClass("woocommerce-cart")) return;

  const cartForm = $(".woocommerce-cart-form");
  if (!cartForm.length) return;

  // Remove item
  $(document).on("click", ".woocommerce-cart-form .remove-item", function (e) {
    e.preventDefault();

    const button = $(this);
    const cartItemKey = button.data("cart-item-key");
    const productName = button.data("product-name");

    removeItem(cartItemKey, productName, button);
  });

  function removeItem(cartItemKey, productName, buttonElement) {
    if (!cartItemKey) {
      console.error("Cart item key not found");
      return;
    }

    const cartRow = buttonElement.closest(".woocommerce-cart-form__cart-item");
    buttonElement.prop("disabled", true);

    $.post(wc_cart_params.ajax_url, {
      action: "erd_remove_cart_item",
      cart_item_key: cartItemKey,
      nonce: nonce,
    })
      .done(function (response) {
        if (response.success) {
          // Show success notifications
          notificationManager.show(messages.removed_from_cart);

          // Smooth animation to remove the row
          cartRow.fadeOut(100, function () {
            cartRow.remove();

            // Check if cart is empty
            if ($(".woocommerce-cart-form__cart-item").length === 0) {
              // Redirect to cart page to show empty cart message
              window.location.reload();
            } else {
              // Just update totals via fragment
              $(document.body).trigger("wc_fragment_refresh");
            }
          });
        }
      })
      .fail(function (xhr, status, error) {
        console.error("Remove item AJAX error:", status, error);
        notificationManager.show(messages.error_generic, "error");
      })
      .always(function () {
        buttonElement.prop("disabled", false);
      });
  }
}
