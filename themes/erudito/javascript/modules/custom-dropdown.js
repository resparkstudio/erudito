/**
 * Code related to custom dropdown rendered by erd_render_dropdown() component
 */

// Define the dropdown component properly
document.addEventListener('alpine:init', () => {
	Alpine.data('erdDropdown', (initialData) => ({
		// Reactive data
		open: initialData.open,
		selected: initialData.selected,
		selectedText: initialData.selectedText,
		dropdownId: initialData.dropdownId,

		// Methods
		selectOption(value, text) {
			this.selected = value;
			this.selectedText = text;
			this.open = false;
			// Dispatch custom event
			this.$dispatch('erd-dropdown-change', {
				value,
				text,
				dropdownId: this.dropdownId,
				attr: initialData.attr,
			});
		},

		// Computed property
		isSelected(value) {
			return this.selected === value;
		},
	}));
});
