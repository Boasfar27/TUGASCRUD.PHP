
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./project/**/*.php", // Semua file PHP di dalam folder 'project'
    "./project/**/**/*.php" // Semua subfolder yang memiliki file PHP
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};



