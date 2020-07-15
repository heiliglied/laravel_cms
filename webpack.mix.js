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
	'bootstrap',
	'popper.js',
	'axios'
];

let autoload = [
	{'jquery': ['$', 'jQuery', 'window.$', 'window.jQuery', 'jquery']},
];

mix.js('resources/js/app.js', 'public/js/app.js');
mix.extract(scripts, 'public/js/vendor');
mix.autoload(autoload);