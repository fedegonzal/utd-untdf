const mix = require("laravel-mix");

mix.setPublicPath('./dist')

//mix.js('./src/js/pages/index.js', 'js').extract(['react', 'react-dom']).react();

mix.js('src/js/app.js', 'js');

mix.sass('./src/sass/style.scss', 'css');

if (mix.inProduction()) {
    mix.version();
}

mix.copyDirectory('./src/images', './dist/images');
