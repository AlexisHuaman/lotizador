/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './src/**/*.{html,js,php}', // Define los archivos donde usarás clases de Tailwind
    './public/**/*.html',
    './**/*.php'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
