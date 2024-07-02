/** @type {import('tailwindcss').Config} */
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
                primary: '#1a202c',
                secondary: '#2d3748',
                accent: '#4a5568',
                // Agrega más colores según la paleta deseada
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
