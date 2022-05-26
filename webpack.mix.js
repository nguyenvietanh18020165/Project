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
const fileNameJs = [
    'ajax',
    'AppAdmin',
    'category_admin',
    'MyApp'
];

const fileNameScss = [
    'AppAdmin',
    'MyApp'
];

for (let i = 0; i < fileNameJs.length; i++){
    mix.js('resources/js/admin/' + fileNameJs[i] + ".js", 'public/js/admin')
        .sourceMaps();
}

for (let i = 0; i < fileNameScss.length; i++){
    mix.sass('resources/sass/admin/' + fileNameScss[i] + ".scss", 'public/css/admin')
        .sourceMaps();
}
//
// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .sourceMaps();

