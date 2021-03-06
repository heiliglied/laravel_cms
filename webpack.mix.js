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
	'vue',
	'toastr',
];

let autoload = [
	{'jquery': ['$', 'jQuery', 'window.$', 'window.jQuery', 'jquery']},
];

mix.js('resources/js/app.js', 'public/mix/js/app.js');
mix.js(['node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'], 'public/mix/js/bootstrap.bundle.min.js').sourceMaps();
mix.js(['node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js'], 'public/mix/js/dataTables.bootstrap4.min.js');
mix.sass('resources/sass/app.scss', 'public/mix/css/app.css');
mix.copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 'public/mix/css/dataTables.bootstrap4.min.css');
mix.extract(scripts, 'public/mix/js/vendor').sourceMaps();
mix.autoload(autoload);