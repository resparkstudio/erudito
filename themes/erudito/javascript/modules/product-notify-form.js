/**
 * AJAX submit product stock notification form
 */

import { notificationManager } from "./notification-manager";

// Access the global variable created by wp_localize_script
const { ajax_url, nonce, messages } = window.erdAjaxData || {};

export function productStockNotificationForm() {
  const form = document.querySelector('[data-preorder="form"]');
  const variationField = form.querySelector('[data-preorder="variation"]');
  const addToCartWrap = document.querySelector('[data-preorder="add-to-cart"]');
  const btn = form.querySelector('button[type="submit"]');
  const btnText = btn.querySelector('[data-preorder="btn-text"]');
  const btnLoader = btn.querySelector('[data-preorder="btn-loader"]');
  const emailInput = form.querySelector('[data-preorder="email"]');
  const formError = form.querySelector('[data-preorder="error"]');

  // Update variation ID when variation changes
  jQuery("body").on("found_variation", function (event, variation) {
    variationField.value = variation.variation_id;
  });

  // Handle preorder form display
  window.jQuery(document).on("found_variation", function (event, variation) {
    if (form) {
      if (!variation.is_in_stock) {
        form.classList.remove("hidden");
        addToCartWrap.classList.add("hidden");
      } else {
        form.classList.add("hidden");
        addToCartWrap.classList.remove("hidden");
      }
    }
  });

  emailInput.addEventListener("input", () => {
    formError.classList.add("hidden");
    emailInput.classList.remove("!border-red2");
  });

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Validate email field
    if (!emailInput.checkValidity() || emailInput.value.trim() === "") {
      formError.classList.remove("hidden");
      emailInput.classList.add("!border-red2");
      return; // Stop form submission
    }

    // Hide any previous errors
    formError.classList.add("hidden");

    const formData = new FormData(form);
    formData.append("action", "handle_preorder_notify");
    formData.append("nonce", nonce);

    // Show loading state
    btnText.classList.add("hidden");
    btnLoader.classList.remove("hidden");
    btn.disabled = true;

    fetch(ajax_url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          notificationManager.show(messages.stock_notification_success);
        } else {
          notificationManager.show(messages.stock_notification_error, "error");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        notificationManager.show(messages.error_generic, "error");
      })
      .finally(() => {
        // Reset button state
        btnText.classList.remove("hidden");
        btnLoader.classList.add("hidden");
        btn.disabled = false;
      });
  });
}
