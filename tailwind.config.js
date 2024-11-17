/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
    './resources/css/**/*.css',
    './resources/js/**/*.jsx',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')({
      datatables: true,
  }),
  ],
}
