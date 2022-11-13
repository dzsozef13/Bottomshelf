/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
  content: ['./app/src/view/*.{html,js,php}', './app/public/layouts/*.{html,js,php}'],
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
      },
      boxShadow: {
        'btn': '0px 16px 60px  rgba(60, 96, 94, 0.4)',
      }
    },
  },
  plugins: [],
}

