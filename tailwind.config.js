/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php"
  ],
  theme: {
    extend: {
      keyframes: {
        input: {
          '0%': { transform: 'translateY(0px)' },
          '100%': { transform: 'translateY(-25px)' },
        },
        toastin: {
          '0%' : { transform: 'translateY(-120%)' },
          '25%': { transform: 'translateY(0)' },
          '50%' : { transform: 'translateY(0)' },
          '75%': { transform: 'translateY(0)' },
          '100%' : { transform: 'translateY(-120%)' },
        },
        toastout: {
          '0%' : { transform: 'translateY(0)' },
          '100%' : { transform: 'translateY(-120%)' },
        }
      },
      animation: {
        input: 'input 0.5s ease-in-out forwards',
        noinput: 'input 0.5s ease-in-out reverse forwards',
        toastin: 'toastin 6.5s forwards ease-in-out',
        toastout: 'toastout 0.5s forwards ease-in-out'
      }
    },
  },
  plugins: [],
}

