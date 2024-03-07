/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './index.html',
    './pages/**/*.{html,js,php}',
    './*.{html,php}'
  ],
  theme: {
    extend: {},
    fontFamily: {
      rubik: ["Rubik", "sans-serif"]
    }
  },
  plugins: [],
}
