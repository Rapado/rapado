const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                blue: {
                    500: '#106BA0'
                },

                primary: {
                    dark: '#0b486b',
                    DEFAULT: '#1284c7',
                    light: '#106BA0'
                },

                secondary: {
                    dark: '#111827',
                    DEFAULT: '#1F2937',
                    light: '#6B7280',
                },

                accent: {
                    dark: '#991B1B',
                    DEFAULT: '#B91C1C',
                    light: '#DC2626,'
                },

                warning: {
                    DEFAULT: '#FBBF24'
                },

                error: {
                    DEFAULT: '#d50000'
                }

                // primary: '#106BA0',
                // primaryClr: '#1284c7',
                // primaryDrk: '#0b486b',

                // secondary
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
