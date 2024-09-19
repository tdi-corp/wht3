/** @type {import('tailwindcss').Config} */
/* eslint-env node */
import primeui from 'tailwindcss-primeui'

export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {},
  },
  plugins: [primeui]
}