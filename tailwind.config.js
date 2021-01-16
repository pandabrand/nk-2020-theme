module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    minWidth: {
      '0': '0',
      '1/4': '25%',
      '1/2': '50%',
      '3/4': '75%',
      'full': '100%',      
    },
    minHeight: {
      '0': '0',
      '1/4': '25%',
      '1/2': '50%',
      '3/4': '75%',
      'full': '100%',      
    },
    fontFamily: {
      sans: [
        "Oxygen",
        "ui-sans-serif",
        "system-ui",
        "-apple-system",
        "BlinkMacSystemFont",
        "Segoe UI",
        "Roboto",
        "Helvetica Neue",
        "Arial",
        "Noto Sans",
        "sans-serif",
        "Apple Color Emoji",
        "Segoe UI Emoji",
        "Segoe UI Symbol",
        "Noto Color Emoji",
      ]
    },
    extend: {
      colors: {
        red: {
          900: '#46121E',
        },
        indigo: {
          400: '#75789B',
          900: '#252E9B',
        },
      },
      width: {
        '200': '200%'
      },
      height: {
        '200': '200%',
        'h-10vh': '10vh',
      },
      screens: {
        'short-phone': {'raw': '(max-width: 375px) and (max-height: 667px)'},
        'long-phone': {'raw': '(max-width: 375px) and (min-height: 668px) and (max-height: 812px)'},
      },
      margin: (theme) => ({
        ...theme('spacing'),
        '1/2': '50%',
        '1/3': '33.333333%',
        '2/3': '66.666667%',
        '1/4': '25%',
        '2/4': '50%',
        '3/4': '75%',
        full: '100%',
      }),
      inset: (theme) => ({
        ...theme('spacing'),
        '1/5': '20%',
        '2/5': '40%',
        '3/5': '60%',
        '4/5': '80%',
        '10vh': '10vh',
      }),
      backgroundPosition: {
        'center-bottom': 'center bottom',
      },
      gridTemplateRows: {
        'grid-rows-two-auto': 'repeat(2, auto)',
      },
    },
  },
  variants: {
    extend: {
      padding: ['hover'],
    },
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}
