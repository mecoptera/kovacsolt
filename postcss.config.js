module.exports = {
  plugins: [
    require('tailwindcss'),
    require('postcss-clean')({
      level : {
        1: {
          all: true,
          normalizeUrls: false
        },
        2: {
          all: true,
          restructureRules: false,
          mergeSemantically: false
        }
      }
    }),
    require('cssnano'),
    require('autoprefixer')
  ]
};
