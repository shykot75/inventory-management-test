/*
// Ensure the DOM is fully loaded before initializing Choices.js
document.addEventListener('DOMContentLoaded', function () {
    // Select all elements with the 'data-choices' attribute
    document.querySelectorAll("[data-choices]").forEach(item => {
        // Initialize an empty object to store Choices.js options
        let choiceData = {};

        // Retrieve all data attributes for the current element
        const dataAttributes = item.dataset;

        console.log(dataAttributes);
        // Iterate over each data attribute to dynamically build the Choices.js options
        for (let key in dataAttributes) {
            // Remove the 'choices' prefix and convert key to camelCase
            const choiceOptionKey = key.replace('choices', '');

            // Convert boolean-like strings to actual booleans
            let value = dataAttributes[key];
            if (value === 'true') value = true;
            if (value === 'false') value = false;

            // Assign the key-value pair to the Choices.js options
            choiceData[choiceOptionKey] = value;
        }

        // // Set some default options or use data attributes to configure Choices.js
        // choiceData.classNames = {
        //     containerOuter: 'choices tailwind-select', // Main container
        //     containerInner: 'choices__inner', // Inner container (input area)
        //     input: 'choices__input', // Input element
        //     inputCloned: 'choices__input--cloned', // Cloned input element
        //     listDropdown: 'choices__list--dropdown bg-white border border-gray-300 rounded-md shadow-lg z-10', // Dropdown list
        //     item: 'choices__item', // Item in the list
        //     itemSelectable: 'choices__item--selectable hover:bg-primary-100 hover:text-primary-500', // Selectable item
        //     itemDisabled: 'choices__item--disabled', // Disabled item
        //     itemChoice: 'choices__item--choice', // Choice item
        //     itemSelected: 'choices__item--selected bg-primary-100 text-primary-500', // Selected item
        //     button: 'choices__button', // Remove button
        // };

        console.log(choiceData);
        // Initialize the Choices.js instance with the constructed options
        new Choices(item, choiceData);
    });
});
*/


document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll("[data-choices]").forEach(item => {
        // Function to convert kebab-case to camelCase
        const kebabToCamel = (str) => {
            return str.replace(/-./g, match => match.charAt(1).toUpperCase());
        };

        // Initialize options object
        let options = {};

        // Iterate over all data attributes
        Array.from(item.attributes).forEach(attr => {
            if (attr.name.startsWith('data-choices-')) {
                // Get the name after 'data-choices-'
                let optionName = attr.name.slice('data-choices-'.length);

                // Convert kebab-case to camelCase
                optionName = kebabToCamel(optionName);

                // Add to options object
                if (attr.value === 'true' || attr.value === 'false') {
                    // Convert string boolean to actual boolean
                    options[optionName] = attr.value === 'true';
                } else if (!isNaN(attr.value)) {
                    // Convert numeric strings to numbers
                    options[optionName] = parseFloat(attr.value);
                } else {
                    options[optionName] = attr.value;
                }
            }
        });
        options['allowHtml'] = true;

        console.log(options)
        // Initialize Choices.js with the generated options
        new Choices(item, options);
    });
});
