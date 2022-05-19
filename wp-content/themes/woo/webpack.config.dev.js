const { merge } = require('webpack-merge');
const common = require('./webpack.config');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
require('dotenv').config();

module.exports = merge(common, {
    plugins: [
        new BrowserSyncPlugin(
            {
                host: process.env.BROWSERSYNC_HOST,
                port: process.env.BROWSERSYNC_PORT,
                proxy: process.env.BROWSERSYNC_PROXY_URL,
                files: [
                    {
                        match: ['./**/*.php', './**/*.css', './**/*.js'],
                        fn: (event, file) => {
                            if (event == 'change') {
                                const bs = require("browser-sync").get("bs-webpack-plugin");
                                if (file.split('.').pop() === 'js' || file.split('.').pop() === 'php') {
                                    bs.reload();
                                } else {
                                    bs.reload("*.css");
                                }
                            }
                        }
                    }
                ],
                injectChanges: true,
            },
            {
                // prevent BrowserSync from reloading the page
                // and let Webpack Dev Server take care of this
                reload: false,
                name: 'bs-webpack-plugin'
            }
        ),
    ],
    watchOptions: {
        ignored: /node_modules/,
    },
    mode: 'development',
});
