/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./client/index.html",
    "./client/views/**/*.{html,js,php}",
    "./*.{html,php}",
    "./client/pages/**/*.{html,js,php}",
  ],
  theme: {
    extend: {},
    fontFamily: {
      rubik: ["Rubik", "sans-serif"],
    },
  },
  plugins: [],
};
