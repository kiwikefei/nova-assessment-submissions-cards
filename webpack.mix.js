let mix = require('laravel-mix')

require('./nova.mix')

mix
  .setPublicPath('dist')
  .js('resources/js/card.js', 'js')
  .vue({ version: 3 })
  .sass('resources/sass/card.scss', 'css')
  .nova('pixelfusion/assessment-submissions-cards')
