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

let scripts = [
	'jquery',
	'axios',
	'jquery-ui',
	'popper.js',
];

let autoload = [
	{'jquery': ['$', 'jQuery', 'window.$', 'window.jQuery', 'jquery']},
];

mix.js('resources/js/app.js', 'public/js/app.js');
mix.js(['node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'], 'public/js/bootstrap.bundle.min.js');
mix.sass('resources/sass/app.scss', 'public/css/app.css');
mix.extract(scripts, 'public/js/vendor');
mix.autoload(autoload);