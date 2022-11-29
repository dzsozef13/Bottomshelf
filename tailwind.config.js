/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
  content: [
  './app/src/view/*.{html,js,php}',
  './app/src/view/auth/*.{html,js,php}',
  './app/public/layouts/*.{html,js,php}',
  './app/public/templates/*.{html,js,php}'
],
  theme: {
    
    fontFamily: {
      sans: "'Lato'",
      mono: "'Space Mono'",
    },
    extend: {
      colors: {
        'highlight-green': {
          900: '#90CA9C',
        },
        'background-black': {
          900: '#151617',
        },
        'background-primary': {
          900: '#151617',
        },
        'background-secondary': {
          900: '#1E2021',
        },
        'background-ternary': {
          900: '#2F3233',
        },
        'dim-white': {
          900: '#D8D8D8',
        },
      },
      boxShadow: {
        'btn': '0px 16px 60px  rgba(60, 96, 94, 0.4)',
      }
    },
  },
  plugins: [],
}

