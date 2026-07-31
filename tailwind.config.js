/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        navy: {
          DEFAULT: '#06111F',
          dark: '#040B15',
          surface: '#081522',
          card: '#0D1D30',
          border: 'rgba(255, 255, 255, 0.1)',
        },
        red: {
          accent: '#EF2029',
          dark: '#C8161E',
          light: 'rgba(239, 32, 41, 0.15)',
        },
        primary: {
          DEFAULT: '#06111F',
          dark: '#040B15',
          light: '#081522',
        },
        accent: {
          DEFAULT: '#EF2029',
          dark: '#C8161E',
          light: 'rgba(239, 32, 41, 0.15)',
        },
      },
      fontFamily: {
        heading: ['"Plus Jakarta Sans"', 'sans-serif'],
        body: ['Inter', 'sans-serif'],
      },
      borderRadius: {
        xl: '1rem',
        '2xl': '1.25rem',
      },
    },
  },
  plugins: [],
}
