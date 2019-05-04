const mix = require("laravel-mix");
const BundleAnalyzerPlugin = require("webpack-bundle-analyzer")
    .BundleAnalyzerPlugin;
require("dotenv").config();

const analyzerMode =
    process.env.NODE_ENV == "production" ? "disabled" : "server";
console.log(process.env.NODE_ENV);

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

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

mix.options({}).sourceMaps(true, "source-map");

mix.browserSync({
    proxy: "expenses.local"
});

mix.webpackConfig({
    plugins: [
        new BundleAnalyzerPlugin({
            analyzerMode
        })
    ]
});
