/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
  content: ['./app/src/view/*.{html,js,php}'],
  theme: {
    extend: {
      colors: {
        test: {
          900: '#90CA9C',
        },
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

