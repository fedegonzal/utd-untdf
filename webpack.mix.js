const mix = require("laravel-mix");

mix.setPublicPath('./dist')


mix.js('./src/js/pages/index.js', 'js').extract(['react', 'react-dom']).react();

mix.sass('./src/sass/style.scss', 'css');


mix.browserSync({
    proxy: 'localhost:8080',
    files: ['./src/**/*.html', './src/**/*.twig', './src/**/*.js', './src/**/*.scss'],
    open: false,
    notify: false
});

if (mix.inProduction()) {
    mix.version();
}


////


require('laravel-mix-twig');

mix.twig({
    root: './src', // Change default root path    
    output: './', // Generate output HTML to this path
    html: {
        inject: false
    },
    flatten: true, // Don't preserve the output directory structure
});


mix.copyDirectory('./src/images', './dist/images');

