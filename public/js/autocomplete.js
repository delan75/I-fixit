/**
 * Generic Autocomplete Class
 *
 * A reusable autocomplete component that can be used for any type of data.
 * Features:
 * - Mobile-friendly dropdown
 * - Keyboard navigation
 * - Customizable data source
 * - Optional display of counts/additional info
 * - Allows custom entries
 * - Supports dependent/hierarchical data (like make->model->variant)
 */

class Autocomplete {
    /**
     * Create a new autocomplete instance
     * @param {string} inputId - The ID of the input element
     * @param {Array|Function} dataSource - Array of items or function that returns filtered items
     * @param {Object} options - Configuration options
     */
    constructor(inputId, dataSource, options = {}) {
        // Default options
        this.options = {
            minChars: 0,                  // Minimum characters before showing suggestions
            delay: 150,                   // Debounce delay in ms
            showCounts: false,            // Whether to show counts next to items
            placeholder: 'Start typing...', // Default placeholder
            noResultsText: 'No matches found', // Text to show when no results
            onSelect: null,               // Callback when an item is selected
            formatItem: null,             // Custom function to format display of items
            valueProperty: null,          // Property to use as value (if items are objects)
            labelProperty: null,          // Property to use as label (if items are objects)
            countProperty: null,          // Property to use as count (if items are objects)
            ...options                    // Override with provided options
        };

        // Elements
        this.input = document.getElementById(inputId);
        this.dropdown = null;

        // Data
        this.dataSource = dataSource;

        // State
        this.isDropdownOpen = false;
        this.selectedValue = '';
        this.debounceTimer = null;

        // Initialize
        if (this.input) {
            this.init();
        } else {
            console.error(`Input element with ID "${inputId}" not found`);
        }
    }

    /**
     * Initialize the autocomplete
     */
    init() {
        // Set placeholder if not already set
        if (!this.input.placeholder) {
            this.input.placeholder = this.options.placeholder;
        }

        // Create dropdown
        this.createDropdown();

        // Set up event listeners
        this.setupEvents();

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!this.input.contains(e.target) && !this.dropdown.contains(e.target)) {
                this.closeDropdown();
            }
        });
    }

    /**
     * Create the dropdown element
     */
    createDropdown() {
        this.dropdown = document.createElement('div');
        this.dropdown.className = 'autocomplete-dropdown hidden';
        this.dropdown.id = `${this.input.id}-dropdown`;

        // Make sure parent has relative positioning for dropdown positioning
        this.input.parentNode.style.position = 'relative';
        this.input.parentNode.appendChild(this.dropdown);
    }

    /**
     * Set up event listeners
     */
    setupEvents() {
        // Input event for filtering
        this.input.addEventListener('input', () => {
            clearTimeout(this.debounceTimer);
            this.debounceTimer = setTimeout(() => {
                const value = this.input.value.trim();
                this.updateDropdown(value);
                if (value.length >= this.options.minChars) {
                    this.openDropdown();
                } else {
                    this.closeDropdown();
                }
            }, this.options.delay);
        });

        // Focus event to show dropdown
        this.input.addEventListener('focus', () => {
            const value = this.input.value.trim();
            if (value.length >= this.options.minChars) {
                this.updateDropdown(value);
                this.openDropdown();
            }
        });

        // Handle keyboard navigation
        this.input.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowDown' && this.isDropdownOpen) {
                e.preventDefault();
                this.focusFirstItem();
            } else if (e.key === 'Escape') {
                this.closeDropdown();
            }
        });
    }

    /**
     * Update the dropdown with filtered items
     * @param {string} filter - The filter text
     */
    updateDropdown(filter) {
        // Clear dropdown
        this.dropdown.innerHTML = '';

        // Get filtered items
        let items = [];
        if (typeof this.dataSource === 'function') {
            // If dataSource is a function, call it with the filter
            items = this.dataSource(filter);
        } else if (Array.isArray(this.dataSource)) {
            // If dataSource is an array, filter it
            items = this.filterItems(this.dataSource, filter);
        }

        // Add items to dropdown
        if (items.length > 0) {
            const ul = document.createElement('ul');
            ul.className = 'autocomplete-list';

            items.forEach(item => {
                const li = document.createElement('li');
                li.className = 'autocomplete-item';
                li.tabIndex = -1;

                // Get the label and value for this item
                const label = this.getItemLabel(item);
                const value = this.getItemValue(item);

                // Format the item display
                if (this.options.formatItem) {
                    // Use custom formatter if provided
                    li.innerHTML = this.options.formatItem(item);
                } else {
                    // Default formatting
                    const count = this.options.showCounts ? this.getItemCount(item) : null;

                    if (count !== null) {
                        li.innerHTML = `${label} <span class="autocomplete-count">(${count})</span>`;
                    } else {
                        li.textContent = label;
                    }
                }

                // Store the value and label for selection
                li.dataset.value = value;
                li.dataset.label = label;

                // Add event listeners
                li.addEventListener('click', () => {
                    this.selectItem(value, label);
                });

                li.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        this.selectItem(value, label);
                    } else if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        this.focusNextItem(li);
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        this.focusPrevItem(li);
                    }
                });

                ul.appendChild(li);
            });

            this.dropdown.appendChild(ul);
        } else {
            this.dropdown.innerHTML = `<div class="autocomplete-no-results">${this.options.noResultsText}</div>`;
        }
    }

    /**
     * Filter items based on input
     * @param {Array} items - The items to filter
     * @param {string} filter - The filter text
     * @returns {Array} - Filtered items
     */
    filterItems(items, filter) {
        if (!filter) return items;

        return items.filter(item => {
            const label = this.getItemLabel(item).toLowerCase();
            return label.includes(filter.toLowerCase());
        });
    }

    /**
     * Get the label to display for an item
     * @param {any} item - The item
     * @returns {string} - The label
     */
    getItemLabel(item) {
        if (typeof item === 'string') {
            return item;
        } else if (this.options.labelProperty && item[this.options.labelProperty] !== undefined) {
            return item[this.options.labelProperty];
        } else if (item.name !== undefined) {
            return item.name;
        } else if (item.label !== undefined) {
            return item.label;
        } else if (item.title !== undefined) {
            return item.title;
        } else {
            return String(item);
        }
    }

    /**
     * Get the value for an item
     * @param {any} item - The item
     * @returns {string} - The value
     */
    getItemValue(item) {
        if (typeof item === 'string') {
            return item;
        } else if (this.options.valueProperty && item[this.options.valueProperty] !== undefined) {
            return item[this.options.valueProperty];
        } else if (item.value !== undefined) {
            return item.value;
        } else if (item.id !== undefined) {
            return item.id;
        } else {
            return this.getItemLabel(item);
        }
    }

    /**
     * Get the count for an item (if applicable)
     * @param {any} item - The item
     * @returns {number|null} - The count or null
     */
    getItemCount(item) {
        if (typeof item === 'object' && item !== null) {
            if (this.options.countProperty && item[this.options.countProperty] !== undefined) {
                return item[this.options.countProperty];
            } else if (item.count !== undefined) {
                return item.count;
            }
        }
        return null;
    }

    /**
     * Select an item
     * @param {string} value - The value to select
     * @param {string} label - The label to display
     */
    selectItem(value, label) {
        this.input.value = label || value;
        this.selectedValue = value;
        this.closeDropdown();

        // Call onSelect callback if provided
        if (typeof this.options.onSelect === 'function') {
            this.options.onSelect(value, label);
        }
    }

    /**
     * Open the dropdown
     */
    openDropdown() {
        this.dropdown.classList.remove('hidden');
        this.isDropdownOpen = true;
    }

    /**
     * Close the dropdown
     */
    closeDropdown() {
        this.dropdown.classList.add('hidden');
        this.isDropdownOpen = false;
    }

    /**
     * Focus the first item in the dropdown
     */
    focusFirstItem() {
        const firstItem = this.dropdown.querySelector('.autocomplete-item');
        if (firstItem) {
            firstItem.focus();
        }
    }

    /**
     * Focus the next item in the dropdown
     * @param {HTMLElement} currentItem - The current focused item
     */
    focusNextItem(currentItem) {
        const nextItem = currentItem.nextElementSibling;
        if (nextItem) {
            nextItem.focus();
        }
    }

    /**
     * Focus the previous item in the dropdown
     * @param {HTMLElement} currentItem - The current focused item
     */
    focusPrevItem(currentItem) {
        const prevItem = currentItem.previousElementSibling;
        if (prevItem) {
            prevItem.focus();
        } else {
            this.input.focus();
        }
    }
}
