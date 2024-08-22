/*
Template Name: brainchildsoft - Admin & Dashboard Template
Author: Brainchildsoft
Version: 1.1.0
Website: https://brainchildsoft.com/
Contact: brainchildsoft@gmail.com
File: input-mask Js File
*/





document.addEventListener("DOMContentLoaded", function() {

    // For Date Input Mask
    if (document.querySelector(".mask-input-date")) {
        document.querySelectorAll('.mask-input-date').forEach(maskInput => {
            const delimiter = maskInput.getAttribute('data-delimiter') || '-';
            const datePattern = maskInput.getAttribute('data-date-pattern') || 'd-m-Y';
            const dateMin = maskInput.getAttribute('data-date-min') || '';
            const dateMax = maskInput.getAttribute('data-date-max') || '';

            var cleaveDate = new Cleave(maskInput, {
                date: true,
                delimiter: delimiter,
                dateMin,
                dateMax,
                datePattern: datePattern.split(delimiter)
            });
        });
    }


    // For Time Input Mask
    if (document.querySelector(".mask-input-time")) {
        document.querySelectorAll('.mask-input-time').forEach(TimeMaskInput => {
            const timePattern = TimeMaskInput.getAttribute('data-time-pattern') || 'h:m:s';
            const timeFormat = TimeMaskInput.getAttribute('data-time-format') || '12';

            var cleaveTime = new Cleave(TimeMaskInput, {
                time: true,
                timePattern: timePattern.split(':'),
                timeFormat: timeFormat
            });
        });
    }

    // for custom Mask Input

    if (document.querySelector(".mask-input-custom")) {
        document.querySelectorAll('.mask-input-custom').forEach(customMaskInput => {
            // Define all possible Cleave.js options and their corresponding data attributes
            const attributeMapping = {
                blocks: 'data-mask-blocks',
                delimiters: 'data-mask-delimiters',
                delimiter: 'data-mask-delimiter',
                uppercase: 'data-mask-uppercase',
                prefix: 'data-mask-prefix',
                numeral: 'data-mask-numeral',
                numeralThousandsGroupStyle: 'data-mask-numeral-thousands-group-style',
                numeralIntegerScale: 'data-mask-numeral-integer-scale',
                numeralDecimalScale: 'data-mask-numeral-decimal-scale',
                numeralDecimalMark: 'data-mask-numeral-decimal-mark',
                signBeforePrefix: 'data-mask-sign-before-prefix',
                tailPrefix: 'data-mask-tail-prefix',
                stripLeadingZeroes: 'data-mask-strip-leading-zeroes',
                numeralPositiveOnly: 'data-mask-numeral-positive-only'
            };

            // Initialize options object
            let options = {};

            // Iterate through the attribute mapping to build the options object
            for (let option in attributeMapping) {
                let dataAttribute = attributeMapping[option];
                let value = customMaskInput.getAttribute(dataAttribute);
                if (value !== null) {
                    switch (option) {
                        case 'blocks':
                        case 'delimiters':
                            options[option] = value.split(',').map(Number.isNaN ? String : Number); // Handle blocks and delimiters
                            break;
                        case 'numeral':
                        case 'uppercase':
                        case 'signBeforePrefix':
                        case 'tailPrefix':
                        case 'stripLeadingZeroes':
                        case 'numeralPositiveOnly':
                            options[option] = value.toLowerCase() === 'true'; // Convert string to boolean
                            break;
                        case 'numeralIntegerScale':
                        case 'numeralDecimalScale':
                            options[option] = parseInt(value, 10); // Convert to integer
                            break;
                        default:
                            options[option] = value; // Use as-is for other string attributes
                    }
                }
            }

            // Initialize Cleave with options
            var cleaveBlocks = new Cleave(customMaskInput, options);
        });
    }
});


