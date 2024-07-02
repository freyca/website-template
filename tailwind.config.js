/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors');

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                'primary': {  // Red
                    '50': '#fff0f0',
                    '100': '#ffddde',
                    '200': '#ffc1c2',
                    '300': '#ff9597',
                    '400': '#ff595c',
                    '500': '#ff262a',
                    '600': '#fc060b',
                    '700': '#c80004',
                    '800': '#af0508',
                    '900': '#900c0f',
                    '950': '#500002',
                },
                'secondary': {  // Black
                    '50': '#f6f6f6',
                    '100': '#e7e7e7',
                    '200': '#d1d1d1',
                    '300': '#b0b0b0',
                    '400': '#888888',
                    '500': '#6d6d6d',
                    '600': '#5d5d5d',
                    '700': '#4f4f4f',
                    '800': '#454545',
                    '900': '#3d3d3d',
                    '950': '#000000',
                },
                'tertiary': { // Green
                    '50': '#f5faf3',
                    '100': '#e6f5e3',
                    '200': '#cdeac8',
                    '300': '#a6d79e',
                    '400': '#77bd6b',
                    '500': '#53a047',
                    '600': '#418336',
                    '700': '#35682d',
                    '800': '#2e5328',
                    '900': '#264522',
                    '950': '#10250e',
                },
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
