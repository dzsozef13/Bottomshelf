/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin')

module.exports = {
  content: [
  './app/src/view/*.{html,js,php}',
  './app/src/view/auth/*.{html,js,php}',
  './app/public/layouts/*.{html,js,php}',
  './app/public/templates/*.{html,js,php}',
  './app/src/model/BE/*.{html,js,php}',
  './app/public/js/*.{html,js,php}',
  './app/*.{html,js,php}'
],
  theme: {
    fontFamily: {
      sans: "'Lato'",
      mono: "'Space Mono'",
    },
    dropShadow: {
      'md': '0px 0px 20px rgba(var(--highlight), 0.6)',
    },
    extend: {
      colors: {
        'highlight-color': {
          900: 'rgba(var(--highlight), <alpha-value>)',
        },
        'background-primary': {
          900: 'rgba(var(--background-primary), <alpha-value>)',
        },
        'background-secondary': {
          900: 'rgba(var(--background-secondary), <alpha-value>)',
        },
        'background-ternary': {
          900: 'rgba(var(--background-ternary), <alpha-value>)',
        },
        'light-color': {
          900: 'rgba(var(--light), <alpha-value>)',
        },
      },
      boxShadow: {
        'btn': '0px 16px 60px rgba(var(--highlight), 0.4)',
      }
    },
  },
  plugins: [],
}

