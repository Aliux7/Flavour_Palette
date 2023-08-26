/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: 'jit',
    content: [
      "./resources/**/**/*.blade.php",
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors:{
                primary: '#343C2D',
                secondary: '#727C4A',
                orange: '#E39D36',
                lgray: '#F3F3F3',
                dgray: '#9E9E9E'
            },
            fontFamily: {
                sans: ['Poppins', 'sans-serif'],
            },
            borderRadius: {
                'default': '5px',
            },
        }
    },
    plugins: [],
  }

