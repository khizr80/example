// tailwind.config.js
const flowbitePlugin = require('flowbite/plugin');

module.exports = {
  darkMode: 'class', // Enable dark mode using class
  content: [
    './resources/views/**/*.blade.php', // Include Blade views
    './resources/js/**/*.vue', // For Vue components if you're using Vue
    './resources/js/**/*.jsx', // For React components if you're using React
    './resources/css/**/*.css', // Include your CSS files
    './node_modules/flowbite/**/*.js', // Include Flowbite's JS files
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          "50": "#eff6ff",
          "100": "#dbeafe",
          "200": "#bfdbfe",
          "300": "#93c5fd",
          "400": "#60a5fa",
          "500": "#3b82f6",
          "600": "#2563eb",
          "700": "#1d4ed8",
          "800": "#1e40af",
          "900": "#1e3a8a",
          "950": "#172554"
        }
      },
      fontFamily: {
        body: [
          'Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 
          'system-ui', 'Segoe UI', 'Roboto', 'Helvetica Neue', 
          'Arial', 'Noto Sans', 'sans-serif', 'Apple Color Emoji', 
          'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'
        ],
        sans: [
          'Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 
          'system-ui', 'Segoe UI', 'Roboto', 'Helvetica Neue', 
          'Arial', 'Noto Sans', 'sans-serif', 'Apple Color Emoji', 
          'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'
        ]
      }
    }
  },
  plugins: [
    flowbitePlugin, // Add Flowbite plugin here
  ]
};
