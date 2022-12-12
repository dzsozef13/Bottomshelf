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
      'md': '0px 0px 20px rgba(144, 202, 156, 0.5)',
    },
    extend: {
      colors: {
        'highlight-color': {
          900: 'var(--highlight)',
        },
        'background-primary': {
          900: 'var(--red)',
        },
        'background-primary': {
          900: 'var(--background-primary)',
        },
        'background-secondary': {
          900: 'var(--background-secondary)',
        },
        'background-ternary': {
          900: 'var(--background-ternary)',
        },
        'light-color': {
          900: 'var(--light)',
        },
      },
      boxShadow: {
        'btn': '0px 16px 60px  rgba(60, 96, 94, 0.4)',
      }
    },
  },
  plugins: [],
}

