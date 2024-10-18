/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {

      fontFamily: {
        arialRounded: ['"Arial Rounded MT Bold"', 'Arial', 'sans-serif'], // Custom font family
      },
    },
  },
  plugins: [],
  // darkMode: ["class"],
  safelist: ["dark"],
}

