let mix = require('laravel-mix');

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
/*
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
*/
mix.js('resources/assets/js/webdashubao/app.js', 'public/webdashubao/vue').version();

mix.js('resources/assets/js/wapdashubao/app.js', 'public/wapdashubao/vue').version();


/*
if (mix.config.inProduction) {
    mix.version();
}
*/
