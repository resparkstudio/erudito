/**
 * Product main price updater for variable products
 */

export function productMainPriceUpdater() {
  const mainPriceElement = document.querySelector("[data-product-price]");
  if (!mainPriceElement) {
    return;
  }

  // Save initial price  html to reset it when no variation is selected
  const initialPriceHTML = mainPriceElement?.innerHTML;

  window.jQuery(document).on("found_variation", function (event, variation) {
    if (mainPriceElement && variation.price_html) {
      mainPriceElement.innerHTML = variation.price_html;
    }
  });

  window.jQuery(document).on("reset_data", function () {
    if (mainPriceElement && initialPriceHTML) {
      mainPriceElement.innerHTML = initialPriceHTML;
    }
  });
}
