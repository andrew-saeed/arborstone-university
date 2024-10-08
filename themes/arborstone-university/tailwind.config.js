/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './*.php',
    './inc/**/*.php',
    './templates/**/*.php',
    './safelist.txt'
  ],
  safelist: [
    'text-center'
    //{
    //  pattern: /text-(white|black)-(200|500|800)/
    //}
  ],
  darkMode: 'selector',
  theme: {
    extend: {
      colors: {
			'white-light': 'var(--white-light)',
			'white-dark': 'var(--white-dark)',
			'black-light': 'var(--black-light)',
			'black-dark': 'var(--black-dark)',
			'black-dim': 'var(--black-dim)',
			'green': 'var(--green)',
			'red': 'var(--red)',
			'yellow': 'var(--yellow)',
			'blue-light': 'var(--blue-light)',
			'blue-dark': 'var(--blue-dark)',
			'blue-dim': 'var(--blue-dim)',
			'gray-light': 'var(--gray-light)',
			'gray-dark': 'var(--gray-dark)',
			'dark-white-light': 'var(--dark-white-light)',
			'dark-white-dark': 'var(--dark-white-dark)',
			'dark-black-dark': 'var(--dark-black-dark)',
			'dark-white-light-dim': 'var(--dark-white-light-dim)',
		},
		screens: {
			'xs': '320px',
			'sm': '425px',
			'md': '768px',
			'lg': '992px',
			'xlg': '1200px',
			'2xlg': '1440px'
		},
		fontSize: {
			'sm': '0.75rem',//12px
			'sm-1': '0.875rem',//14px
			'base': '1rem',//16px
			'base-1': '1.125rem',//18px
			'base-2': '1.25rem',//20px
			'medium': '1.375rem',//22px
			'medium-1': '1.5rem',//24px
			'medium-2': '1.75rem',//28px
			'large': '2.25rem',//36px
			'xlarge': '3.75rem',//60px
			'xxlarge': '5rem'//80px
		},
		lineHeight: {
			'base': '1.625rem', //26px
			'base-1': '1.75rem', //28px
			'medium-1': '2.125rem', //34px
			'medium-2': '2.375rem', //38px
			'large': '2.875rem', //46px
			'xxlarge': '5.625rem' //90px
		},
		boxShadow: {
			'base': '2px 2px 1px rgba(0, 0, 0, 0.07)'
		}
    }
  },
  plugins: []
}