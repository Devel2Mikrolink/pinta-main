const mix = require("laravel-mix");

const VuetifyLoaderPlugin = require("vuetify-loader/lib/plugin");

var CaseSensitivePathsPlugin = require("case-sensitive-paths-webpack-plugin");

var webpackConfig = {
    plugins: [
        new CaseSensitivePathsPlugin()
        // other plugins ...
    ],
    resolve: {
        alias: {
            vue$: "vue/dist/vue.runtime.esm.js",
            "@": path.resolve("resources/js")
        }
    }
    // other webpack config ...
};

mix.webpackConfig(webpackConfig);
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

mix.extend(
    "vuetify",
    new (class {
        webpackConfig(config) {
            config.plugins.push(new VuetifyLoaderPlugin());
        }
    })()
);
mix.vuetify();
