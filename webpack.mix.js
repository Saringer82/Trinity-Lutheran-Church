const {mix} = require('laravel-mix');

mix
    //.js('resources/js/app.js', 'public/js')
    // .sass('resources/sass/app.scss', 'public/css/index');
    .sass('sass/theme.scss', 'public/application/themes/apt206/css/theme.css');
