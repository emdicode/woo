const mix = require('laravel-mix')

mix.setPublicPath('assets');

mix.webpackConfig({
    stats: {
        children: false,
    }
});

mix.js('src/js/main.js', './assets/main.min.js').extract();

mix.postCss('src/css/main.css', './assets/main.min.css', [
    require('postcss-import')(),
    require('tailwindcss/nesting')(),
    require('tailwindcss')(),
    require('postcss-preset-env')({
        features: { 'nesting-rules': false },
    }),
    require('autoprefixer')(),
    require('cssnano')({
        enabled: mix.inProduction()
    }),
]);

if (!mix.inProduction()) {
    mix.sourceMaps();
}

if (mix.inProduction()) {
    mix.version();
}
