const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.sass('resources/scss/app.scss', 'public/css')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/alpine.js', 'public/assets/dist/js')
    .js('resources/js/plugins.js', 'public/assets/dist/js')
    .version([
        'public/js/app.js',
        'public/assets/dist/js/alpine.js',
        'public/assets/dist/js/plugins.js',
    ]);

// mix.scripts([
//         'node_modules/jquery/dist/jquery.min.js'
//     ],
//     'public/js/vendor.js')
//     .scripts([
//         'resources/js/app.js'
//     ],
//     'public/js/app.js')
//     .version([
//         'public/js/vendor.js',
//         'public/js/app.js'
//     ]);

//
// mix.postCss('resources/css/plugins.css', 'public/plugins')
//     .js('resources/js/plugins.js', 'public/plugins');
//
// mix.postCss('resources/assets/dist/css/adminlte.min.css', 'public/css/theme.css')
//     .sourceMaps();
//
// // mix.postCss('resources/css/app.css', 'public/css')
// mix.sass('resources/scss/app.scss', 'public/css')
//     .js('resources/js/app.js', 'public/js');
//
// mix.js('resources/vendor/alpinejs/alpine.js', 'public/js');
// mix.js('resources/assets/dist/js/adminlte.min.js', 'public/js/theme.js')
//     .sourceMaps();
