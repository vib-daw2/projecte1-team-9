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
          '0%': { transform: 'translateY(-120%)' },
          '25%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(0)' },
          '75%': { transform: 'translateY(0)' },
          '100%': { transform: 'translateY(-120%)' },
        },
        toastout: {
          '0%': { transform: 'translateY(0)' },
          '100%': { transform: 'translateY(-120%)' },
        },
        slide_in_from_left: {
          '0%': { transform: 'translateX(100%)' },
          '100%': { transform: 'translateX(0px)' }
        }
      },
      animation: {
        input: 'input 0.5s ease-in-out forwards',
        noinput: 'input 0.5s ease-in-out reverse forwards',
        toastin: 'toastin 4s forwards ease-in-out',
        toastout: 'toastout 0.5s forwards ease-in-out',
        slidein: 'slide_in_from_left 0.5s forwards ease-in-out',
        slideout: 'slide_in_from_left 0.5s reverse ease-in-out'
      },
      fontSize: {
        xxl: ['1.75rem', '2.5rem'],
      }
    },
  },
  plugins: [],
}

