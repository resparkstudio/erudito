/**
 * Custom variation dropdown sync with native WooCommerce select inputs
 */

export function productVariationDropdown() {
  document.addEventListener("erd-dropdown-change", (e) => {
    if (!e.detail.attr["data-variation-input"]) return;

    // Getting native WooCommerce variation input name
    const variationInputName = e.detail.attr["data-variation-input"];

    // Get selected value from custom dropdown component
    const selectedValue = e.detail.value;

    // Getting native WooCommerce variation input element
    const variationInputEl = document.querySelector(
      `select[name="${variationInputName}"]`,
    );

    // Setting the value of native input
    variationInputEl.value = selectedValue;

    // Removing error state
    const dropdownWrap = e.target.closest("[data-variation-input]");
    const dropdownBtn = dropdownWrap.querySelector("button");

    dropdownBtn.classList.remove("border-red2");

    // Trigger WooCommerce's variation check
    if (window.jQuery) {
      window.jQuery(variationInputEl).trigger("change");
    }
  });
}
