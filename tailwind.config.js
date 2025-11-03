tailwind.config.js
import forms from '@tailwindcss/forms';
import containerQueries from '@tailwindcss/container-queries';

export default {
    darkMode: 'class',
    content: [
        './resources/views//*.blade.php',
        './resources/js//.js',
        './resources/**/.vue',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#29a847',
                'background-light': '#f6f8f6',
                'background-dark': '#131f16',
            },
            fontFamily: { display: ['Inter', 'sans-serif'] },
            borderRadius: { DEFAULT: '0.5rem', lg: '1rem', xl: '1.5rem', full: '9999px' },
        },
    },
    plugins: [forms, containerQueries],
    safelist: [
        'flex', 'items-center', 'justify-between',
        'bg-primary', 'text-white', 'text-gray-700', 'dark:text-gray-300',
        'rounded-lg', 'px-4', 'py-4', 'h-10', 'h-12',
        'container', 'mx-auto', 'max-w-5xl'
    ],
};