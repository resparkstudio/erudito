/**
 * Custom variation dropdown sync with native WooCommerce select inputs
 */

export function productVariationDropdown() {
  // Get the variation data that WooCommerce already provides
  const variationForm = document.querySelector("form.variations_form");
  const variationData = JSON.parse(
    variationForm?.dataset.product_variations || "[]",
  );

  // Function to get available options based on current selections
  function getAvailableOptions(currentSelections = {}) {
    const availableOptions = {};

    // Only consider selections that actually have values
    const activeSelections = Object.fromEntries(
      Object.entries(currentSelections).filter(
        ([attr, value]) => value && value !== "",
      ),
    );

    // For each attribute, find what values are available
    const allAttributes = new Set();
    variationData.forEach((variation) => {
      Object.keys(variation.attributes).forEach((attr) => {
        allAttributes.add(attr);
      });
    });

    allAttributes.forEach((attr) => {
      availableOptions[attr] = new Set();

      // For this attribute, check each possible value
      const allValuesForAttr = new Set();
      variationData.forEach((variation) => {
        if (variation.attributes[attr]) {
          allValuesForAttr.add(variation.attributes[attr]);
        }
      });

      allValuesForAttr.forEach((value) => {
        // Check if this value can be selected given current selections
        const testSelections = { ...activeSelections, [attr]: value };

        // Find if there's any in-stock variation that matches these selections
        const hasValidVariation = variationData.some((variation) => {
          const matchesSelections = Object.entries(testSelections).every(
            ([testAttr, testValue]) => {
              return variation.attributes[testAttr] === testValue;
            },
          );
          return matchesSelections && variation.is_in_stock;
        });

        if (hasValidVariation) {
          availableOptions[attr].add(value);
        }
      });
    });

    // Convert Sets to Arrays for easier use
    Object.keys(availableOptions).forEach((attr) => {
      availableOptions[attr] = Array.from(availableOptions[attr]);
    });

    return availableOptions;
  }

  // Function to get current selections from all dropdowns
  function getCurrentSelections() {
    const selections = {};
    const dropdowns = document.querySelectorAll("[data-variation-input]");

    dropdowns.forEach((dropdown) => {
      const attr = dropdown.dataset.variationInput;
      const alpineData = Alpine.$data(dropdown);
      if (alpineData && alpineData.selected) {
        selections[attr] = alpineData.selected;
      }
    });

    return selections;
  }

  // Function to update dropdown options UI
  function updateDropdownAvailability() {
    const currentSelections = getCurrentSelections();
    const availableOptions = getAvailableOptions(currentSelections);

    // Update each dropdown's Alpine component
    const dropdowns = document.querySelectorAll("[data-variation-input]");
    dropdowns.forEach((dropdown) => {
      const attr = dropdown.dataset.variationInput;
      const alpineData = Alpine.$data(dropdown);

      if (alpineData && availableOptions[attr]) {
        // Get all possible values for this attribute
        const allOptions = Array.from(dropdown.querySelectorAll("[data-value]"))
          .map((option) => option.dataset.value)
          .filter((value) => value); // Remove empty values

        // Find unavailable options
        const unavailableOptions = allOptions.filter(
          (value) => !availableOptions[attr].includes(value),
        );

        // Update Alpine component state
        alpineData.setUnavailableOptions(unavailableOptions);
      }
    });
  }

  // Set initial availability on page load
  if (variationData.length > 0) {
    updateDropdownAvailability();
  }

  document.addEventListener("erd-dropdown-change", (e) => {
    if (!e.detail.attr["data-variation-input"]) return;

    // Getting native WooCommerce variation input
    const variationInputName = e.detail.attr["data-variation-input"];
    const variationInputEl = document.querySelector(
      `select[name="${variationInputName}"]`,
    );

    // Set the value of native input
    const selectedValue = e.detail.value;
    variationInputEl.value = selectedValue;

    // Removing error state
    const dropdownWrap = e.target.closest("[data-variation-input]");
    const alpineData = Alpine.$data(dropdownWrap);
    alpineData.hideError();

    // Update availability for all dropdowns after selection
    updateDropdownAvailability();

    // Trigger WooCommerce's variation check
    if (window.jQuery) {
      window.jQuery(variationInputEl).trigger("change");
    }
  });

  window.jQuery(document).on("reset_data", function () {
    // Reset availability when variations are cleared
    updateDropdownAvailability();
  });
}
