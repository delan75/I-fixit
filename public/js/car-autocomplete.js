/**
 * Car Attributes Autocomplete
 *
 * This script provides autocomplete functionality for car attributes:
 * - Make, Model, and Variant (with dependencies)
 * - Body Type
 * - Color
 *
 * It uses the generic Autocomplete class and the car data files.
 */

class CarAutocomplete {
    /**
     * Initialize car attributes autocomplete with dependencies
     * @param {string} makeInputId - ID of the make input element
     * @param {string} modelInputId - ID of the model input element
     * @param {string} variantInputId - ID of the variant input element (optional)
     * @param {string} bodyTypeInputId - ID of the body type input element (optional)
     * @param {string} colorInputId - ID of the color input element (optional)
     */
    constructor(makeInputId, modelInputId, variantInputId = null, bodyTypeInputId = null, colorInputId = null) {
        this.makeInputId = makeInputId;
        this.modelInputId = modelInputId;
        this.variantInputId = variantInputId;
        this.bodyTypeInputId = bodyTypeInputId;
        this.colorInputId = colorInputId;

        this.selectedMake = '';
        this.selectedModel = '';

        // Initialize autocompletes
        this.initMakeModel();

        if (this.variantInputId) {
            this.initVariant();
        }

        if (this.bodyTypeInputId) {
            this.initBodyType();
        }

        if (this.colorInputId) {
            this.initColor();
        }
    }

    /**
     * Initialize make and model autocomplete
     */
    initMakeModel() {
        // Make autocomplete
        this.makeAutocomplete = new Autocomplete(this.makeInputId, carData.makes, {
            placeholder: 'Start typing to see suggestions...',
            onSelect: (value) => {
                this.selectedMake = value;

                // Clear model and variant when make changes
                const modelInput = document.getElementById(this.modelInputId);
                if (modelInput) {
                    modelInput.value = '';
                    this.selectedModel = '';
                    setTimeout(() => modelInput.focus(), 100);
                }

                // Clear variant if it exists
                if (this.variantInputId) {
                    const variantInput = document.getElementById(this.variantInputId);
                    if (variantInput) {
                        variantInput.value = '';
                    }
                }
            }
        });

        // Model autocomplete (depends on selected make)
        this.modelAutocomplete = new Autocomplete(this.modelInputId, (filter) => {
            const make = document.getElementById(this.makeInputId).value.trim();

            // If make exists in our data, filter its models
            if (make && carData.models[make]) {
                if (!filter) return carData.models[make];

                return carData.models[make].filter(model =>
                    model.toLowerCase().includes(filter.toLowerCase())
                );
            }

            return [];
        }, {
            placeholder: 'Select make first...',
            noResultsText: document.getElementById(this.makeInputId).value.trim()
                ? 'No matching models found'
                : 'Please select a make first',
            onSelect: (value) => {
                this.selectedModel = value;

                // Focus variant input if it exists
                if (this.variantInputId) {
                    const variantInput = document.getElementById(this.variantInputId);
                    if (variantInput) {
                        variantInput.value = '';
                        setTimeout(() => variantInput.focus(), 100);
                    }
                }
            }
        });
    }

    /**
     * Initialize variant autocomplete (depends on make and model)
     */
    initVariant() {
        this.variantAutocomplete = new Autocomplete(this.variantInputId, (filter) => {
            const make = document.getElementById(this.makeInputId).value.trim();
            const model = document.getElementById(this.modelInputId).value.trim();

            // If we have both make and model and they exist in our variants data
            if (make && model) {
                let variants = getCarVariants(make, model);

                if (variants.length > 0) {
                    if (!filter) return variants;

                    return variants.filter(variant =>
                        variant.toLowerCase().includes(filter.toLowerCase())
                    );
                }
            }

            return [];
        }, {
            placeholder: 'Select model first...',
            noResultsText: (() => {
                const make = document.getElementById(this.makeInputId).value.trim();
                const model = document.getElementById(this.modelInputId).value.trim();

                if (!make) return 'Please select a make first';
                if (!model) return 'Please select a model first';
                return 'No variants found for this model';
            })()
        });
    }

    /**
     * Initialize body type autocomplete
     */
    initBodyType() {
        this.bodyTypeAutocomplete = new Autocomplete(this.bodyTypeInputId, carAttributesData.bodyTypes, {
            placeholder: 'Start typing to see body types...'
        });
    }

    /**
     * Initialize color autocomplete
     */
    initColor() {
        this.colorAutocomplete = new Autocomplete(this.colorInputId, carAttributesData.colors, {
            placeholder: 'Start typing to see colors...'
        });
    }

    /**
     * Static method to initialize all car autocomplete fields on a form
     * @param {Object} options - Configuration options with input IDs
     */
    static initializeAll(options = {}) {
        const {
            makeInputId = 'make',
            modelInputId = 'model',
            variantInputId = 'variant',
            bodyTypeInputId = 'body_type',
            colorInputId = 'color'
        } = options;

        // Check which elements exist
        const makeInput = document.getElementById(makeInputId);
        const modelInput = document.getElementById(modelInputId);
        const variantInput = document.getElementById(variantInputId);
        const bodyTypeInput = document.getElementById(bodyTypeInputId);
        const colorInput = document.getElementById(colorInputId);

        // Only initialize if the required elements exist
        if (makeInput && modelInput) {
            return new CarAutocomplete(
                makeInputId,
                modelInputId,
                variantInput ? variantInputId : null,
                bodyTypeInput ? bodyTypeInputId : null,
                colorInput ? colorInputId : null
            );
        } else {
            console.warn('Required car form elements not found');
            return null;
        }
    }
}
