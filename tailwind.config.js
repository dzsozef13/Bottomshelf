/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
  content: ['./app/src/view/*.{html,js,php}'],
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
        'dim-white': {
          900: '#D8D8D8',
        },
      }
    },
  },
  plugins: [],
}

