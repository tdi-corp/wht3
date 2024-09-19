/** @type {import('tailwindcss').Config} */
const primeui = require('tailwindcss-primeui');

export default {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {},
  },
  plugins: [primeui]
}

