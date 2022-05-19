const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: [
        'regenerator-runtime/runtime',
        './src/js/main.js'
    ],
    output: {
        path: path.resolve(__dirname, 'assets/'),
        filename: 'main.js',
        publicPath: '/'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                include: path.resolve(__dirname, 'src'),
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
            {
                // Apply rule for .sass, .scss or .css files
                test: /\.(sa|sc|c)ss$/,
                use: [
                    {
                        // After all CSS loaders, we use a plugin to do its work.
                        // It gets all transformed CSS and extracts it into separate
                        // single bundled file
                        loader: MiniCssExtractPlugin.loader,
                    },
                    {
                        // This loader resolves url() and @imports inside CSS
                        loader: 'css-loader',
                        options: {
                            url: false
                        }
                    },
                    {
                        // Then we apply postCSS fixes like autoprefixer and minifying
                        loader: 'postcss-loader'
                    },
                    {
                        // First we transform SASS to standard CSS
                        loader: 'sass-loader',
                        options: {
                            implementation: require('sass'),
                        },
                    },
                ],
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'main.css',
        })
    ],
};
