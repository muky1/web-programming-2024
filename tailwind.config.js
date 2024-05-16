/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./tpl/**/*.{html,js,php}",
    "./*.{html,php}",
    "./pages/**/*.{html,js,php}",
  ],
  theme: {
    extend: {},
    fontFamily: {
      rubik: ["Rubik", "sans-serif"],
    },
  },
  plugins: [],
};
