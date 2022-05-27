buildResolving() {
    this.webpackConfig.resolve = {
        extensions: ['*', '.js', '.jsx', '.vue'],

        alias: {
            vue$: 'vue/dist/vue.common.js'
        }
    };

    return this;
}  