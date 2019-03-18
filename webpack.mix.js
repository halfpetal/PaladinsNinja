const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//    .js('node_modules/particles.js/particles.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

// General Assets
mix.js('node_modules/particles.js/particles.js', 'public/js');

// EarlyAccess Theme
mix.js('resources/views/EarlyAccess/js/app.js', 'public/EarlyAccess/js')
   .sass('resources/views/EarlyAccess/sass/app.scss', 'public/EarlyAccess/css');