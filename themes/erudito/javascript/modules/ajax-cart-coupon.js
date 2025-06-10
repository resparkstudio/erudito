/**
 * AJAX coupon form on cart page
 */
import { notificationManager } from "./notification-manager";
const $ = window.jQuery;
const { nonce, messages } = window.erdAjaxData || {};

export function ajaxCartCouponForm() {
  const form = $('[data-coupon-form="form"]');

  if (!form.length) return;

  const error = $('[data-coupon-form="error"]', form);
  const input = $('[data-coupon-form="input"]', form);
  const applyBtn = $('[data-coupon-form="apply-btn"]', form);
  const removeBtn = $('[data-coupon-form="remove-btn"]', form);

  function showError(message) {
    error.text(message);
    error.show();
    input.addClass("border-red2");
  }

  function hideError() {
    error.hide();
    input.removeClass("border-red2");
  }

  function showSubmitState() {
    applyBtn.removeClass("hidden").addClass("flex");
    removeBtn.removeClass("flex").addClass("hidden");
  }

  function showRemoveState() {
    applyBtn.removeClass("flex").addClass("hidden");
    removeBtn.removeClass("hidden").addClass("flex");
  }

  // Apply coupon
  form.on("submit", function (e) {
    e.preventDefault();

    const couponCode = input.val().trim();
    if (!couponCode) {
      showError(messages.empty_coupon);
      return;
    }

    $.post(wc_cart_params.ajax_url, {
      action: "erd_apply_coupon_ajax",
      coupon_code: couponCode,
      nonce: nonce,
    })
      .done(function (response) {
        if (response.success) {
          $(document.body).trigger("wc_fragment_refresh");
          hideError();
          showRemoveState();
          notificationManager.show(response.data.message);
        } else {
          showError(response.data.message);
        }
      })
      .fail(function (xhr, status, error) {
        console.error("Apply coupon AJAX error:", status, error);
        showError(messages.error_generic);
      })
      .always(function () {
        // Remove loading state if needed
      });
  });

  // Remove coupon
  removeBtn.on("click", function (e) {
    $.post(wc_cart_params.ajax_url, {
      action: "erd_remove_coupon_ajax",
      nonce: nonce,
    })
      .done(function (response) {
        if (response.success) {
          $(document.body).trigger("wc_fragment_refresh");
          notificationManager.show(response.data.message);
          error.hide();
          input.val("");
          showSubmitState();
        } else {
          showError(response.data.message);
        }
      })
      .fail(function (xhr, status, error) {
        console.error("Remove coupon AJAX error:", status, error);
        showError(messages.error_generic);
      })
      .always(function () {
        // Remove loading state if needed
      });
  });
}
