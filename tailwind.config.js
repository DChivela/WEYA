import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            keyframes: {
                slowPulse: {
                    '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                    '50%': { transform: 'scale(1.05)', opacity: '0.9' },
                },
                swing: {
                    '0%, 100%': { transform: 'rotate(0deg)' },
                    '25%': { transform: 'rotate(3deg)' },
                    '75%': { transform: 'rotate(-3deg)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-4px)' },
                },
            },
            animation: {
                slowPulse: 'slowPulse 3s ease-in-out infinite',
                swing: 'swing 4s ease-in-out infinite',
                float: 'float 5s ease-in-out infinite',
            },
            keyframes: {
                slowPulse: {
                    '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                    '50%': { transform: 'scale(1.08)', opacity: '0.9' },
                },
                swing: {
                    '0%, 100%': { transform: 'rotate(0deg)' },
                    '25%': { transform: 'rotate(3deg)' },
                    '75%': { transform: 'rotate(-3deg)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-4px)' },
                },
                carDrive: {
                    '0%': { transform: 'translateX(-150%)' },
                    '50%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(150%)' },
                },
            },
            animation: {
                slowPulse: 'slowPulse 3s ease-in-out infinite',
                swing: 'swing 4s ease-in-out infinite',
                float: 'float 5s ease-in-out infinite',
                carDrive: 'carDrive 4s ease-in-out infinite',
            },

        }
    },

    plugins: [forms],
};
