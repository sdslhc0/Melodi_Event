import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                brown: {
                    50: '#fdf8f6',
                    100: '#f5ebe4',
                    200: '#e8d5c4',
                    300: '#d4b896',
                    400: '#c19a6b',
                    500: '#a67c52',
                    600: '#8b5e3c',
                    700: '#6b4226',
                    800: '#4a2c17',
                    900: '#2d1810',
                    950: '#1a0e09',
                },
                gold: {
                    50: '#fffdf0',
                    100: '#fef9e1',
                    200: '#fdf0b8',
                    300: '#fce588',
                    400: '#f5d565',
                    500: '#d4a843',
                    600: '#b8922e',
                    700: '#9a7a24',
                    800: '#7d6320',
                    900: '#5c4a18',
                },
                dark: {
                    DEFAULT: '#1a1209',
                    100: '#2d2218',
                    200: '#3d3024',
                    300: '#4d3e30',
                    400: '#5d4c3c',
                    500: '#6d5a48',
                },
            },
            fontFamily: {
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'hero-pattern': "url('/images/hero-bg.jpg')",
            },
        },
    },

    plugins: [forms],
};
