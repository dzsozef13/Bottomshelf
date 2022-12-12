/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin')



module.exports = {
  content: [
  './app/src/view/*.{html,js,php}',
  './app/src/view/auth/*.{html,js,php}',
  './app/public/layouts/*.{html,js,php}',
  './app/public/templates/*.{html,js,php}',
  './app/src/model/BE/*.{html,js,php}',
  './app/public/js/*.{html,js,php}'
],
  plugins: [
    plugin(function({ matchVariant }) {
      matchVariant(
        'mode',
        (value) => {
          return `&:mode(${value})`;
        },
        {
          values: {
            green: 'green',
            blue: 'blue',
            red: 'red',
          }
        }
      );
    })
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
          900: 'var(--red)',
        },
      },
      boxShadow: {
        'btn': '0px 16px 60px  rgba(60, 96, 94, 0.4)',
      }
    },
  },
  plugins: [],
}

