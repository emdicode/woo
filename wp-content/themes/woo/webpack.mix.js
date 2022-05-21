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
    require('tailwindcss')('./tailwind.config.js'),
    require('postcss-nested')(),
    require('postcss-preset-env')(),
    require('autoprefixer')(),
]);

if (!mix.inProduction()) {
    mix.sourceMaps();
}

if (mix.inProduction()) {
    mix.version();
}
