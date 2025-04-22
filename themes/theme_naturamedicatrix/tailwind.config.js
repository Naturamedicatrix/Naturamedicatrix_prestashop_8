/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./templates/**/*.tpl",
    "../classic/templates/**/*.tpl",
    "./assets/js/**/*.js"
  ],
  // Préfixer les classes Tailwind pour éviter les conflits avec Bootstrap
  prefix: 'tw-',
  theme: {
    extend: {
      colors: {
        'color-custom-green': '#83B58B',
        'color-custom-red': '#E45B7F',
        'color-custom-white': '#F9FAFB',
        'color-custom-grayLight': '#EDEFF1',
        'color-custom-blue': '#93A7C3',
        'color-custom-text-black': '#4B5563',
        'color-custom-title-black': '#111827'
      },
    },
  },
  plugins: [],
}
