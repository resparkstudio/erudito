/**
 * Code related to custom dropdown rendered by erd_render_dropdown() component
 */

// Define the dropdown component properly
document.addEventListener("alpine:init", () => {
  Alpine.data("erdDropdown", (initialData) => ({
    // Reactive data
    open: initialData.open,
    selected: initialData.selected,
    selectedText: initialData.selectedText,
    dropdownId: initialData.dropdownId,
    error: initialData.error,
    unavailableOptions: [],

    // Methods
    selectOption(value, text) {
      this.selected = value;
      this.selectedText = text;
      this.open = false;
      // Dispatch custom event
      this.$dispatch("erd-dropdown-change", {
        value,
        text,
        dropdownId: this.dropdownId,
        attr: initialData.attr,
      });
    },

    isSelected(value) {
      return this.selected === value;
    },

    isAvailable(value) {
      return !this.unavailableOptions.includes(value);
    },

    showError() {
      this.error = true;
    },

    hideError() {
      this.error = false;
    },

    // Method to update availability from external JS
    setUnavailableOptions(unavailableArray) {
      this.unavailableOptions = unavailableArray;
    },
  }));
});
