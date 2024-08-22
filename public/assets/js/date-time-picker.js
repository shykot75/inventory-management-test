document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll("[data-flatpickr]").forEach(item => {
        // Function to convert kebab-case to camelCase
        const kebabToCamel = (str) => {
            return str.replace(/-./g, match => match.charAt(1).toUpperCase());
        };

        // Initialize options object
        let options = {};

        // Iterate over all data attributes
        Array.from(item.attributes).forEach(attr => {
            if (attr.name.startsWith('data-flatpickr-')) {
                // Get the name after 'data-flatpickr-'
                let optionName = attr.name.slice('data-flatpickr-'.length);

                // Convert kebab-case to camelCase
                optionName = kebabToCamel(optionName);

                // Add to options object
                if (attr.value === 'true' || attr.value === 'false') {
                    // Convert string boolean to actual boolean
                    options[optionName] = attr.value === 'true';
                } else if (!isNaN(attr.value)) {
                    // Convert numeric strings to numbers
                    options[optionName] = parseFloat(attr.value);
                } else if (optionName === 'disable' || optionName === 'enable') {
                    // Convert comma-separated values into arrays for `disable` or `enable`
                    options[optionName] = attr.value.split(',').map(date => date.trim());
                } else {
                    options[optionName] = attr.value;
                }
            }
        });

        // Initialize Flatpickr with the generated options
        flatpickr(item, options);
        console.log(options)
    });
});
