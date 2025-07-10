const plugin = require('tailwindcss/plugin');

module.exports = {
    content: [
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                menu: {
                    link: 'rgba(var(--menu-link-color, 255, 255, 255), <alpha-value>)',
                    hover: 'rgba(var(--menu-hover-color, var(--secondary)), <alpha-value>)',
                    active: {
                        bg: 'rgba(var(--menu-active-bg, var(--primary)), <alpha-value>)',
                        color: 'rgba(var(--menu-active-color, 255, 255, 255), <alpha-value>)',
                    },
                    current: {
                        bg: 'rgba(var(--menu-current-bg, 248, 250, 252), <alpha-value>)',
                        color: 'rgba(var(--menu-current-color, 0, 0, 0), <alpha-value>)',
                    },
                    dropdown: {
                        bg: 'rgba(var(--menu-dropdown-bg, var(--dark-600)), <alpha-value>)',
                    },
                },
            },
            borderRadius: {
                'full': 'var(--radius-full, 9999px)',
            },
            transitionProperty: {
                colors:
                    'color, background-color, border-color, text-decoration-color, box-shadow, fill, stroke',
            },
            transitionDuration: {
                DEFAULT: '350ms',
            },
            zIndex: {
                '39': '39',
            },
            opacity: {
                '5': '.5',
            },
            keyframes: {
                wiggle: {
                    '0%, 100%': {transform: 'rotate(-15deg)'},
                    '50%': {transform: 'rotate(15deg)'},
                },
            },
            animation: {
                wiggle: 'wiggle 2.5s ease-in-out infinite',
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio')
    ],
}
