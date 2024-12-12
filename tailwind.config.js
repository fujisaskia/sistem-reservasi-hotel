/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        fontFamily: {
          playfair: ['"Playfair Display"', 'serif'],
          poppins: ['"Poppins"', 'sans-serif'],
        },  
        scrollBehavior: {
          smooth: 'smooth',
        },
      },
    },
    plugins: [
      function ({ addUtilities }) {
        addUtilities({
          '.no-scrollbar': {
            /* Menghilangkan scrollbar di Webkit dan Firefox */
            '-ms-overflow-style': 'none',     /* IE and Edge */
            'scrollbar-width': 'none',        /* Firefox */
          },
          '.no-scrollbar::-webkit-scrollbar': {
            display: 'none', /* Webkit */
          },
        });
      },
    ],
  }