/* =============== KopiAsa Shared Tailwind Config =============== */
tailwind.config = {
  theme: {
    extend: {
      colors: {
        coffee: {
          50:  '#FBF6EF',
          100: '#F3E6D2',
          200: '#E2C39B',
          300: '#C99764',
          400: '#A6703B',
          500: '#7A4A24',
          600: '#5C3518',
          700: '#3F230F',
          800: '#2A1709',
          900: '#180D05',
        },
        leaf: {
          50:  '#F1F6EE',
          100: '#DCE8D2',
          200: '#B5CDA0',
          300: '#85AE6A',
          400: '#5C8E45',
          500: '#3F6E2F',
          600: '#2F5523',
          700: '#223E1A',
        },
        cream: {
          50:  '#FDFAF4',
          100: '#FAF3E5',
          200: '#F4E8CE',
        },
        ember: {
          400: '#E8B061',
          500: '#D89744',
        }
      },
      fontFamily: {
        script: ['"Dancing Script"', 'cursive'],
        serif:  ['"Cormorant Garamond"', 'serif'],
        sans:   ['Inter', 'sans-serif'],
      },
      boxShadow: {
        'soft': '0 4px 20px -2px rgba(63, 35, 15, 0.08)',
        'card': '0 2px 12px -1px rgba(63, 35, 15, 0.06)',
        'lift': '0 12px 32px -8px rgba(63, 35, 15, 0.18)',
      }
    }
  }
};

/* Initialize Lucide icons after DOM loaded */
window.addEventListener('DOMContentLoaded', () => {
  if (window.lucide) lucide.createIcons();
});
