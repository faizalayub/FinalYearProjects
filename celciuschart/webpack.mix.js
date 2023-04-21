let mix = require('laravel-mix');

mix.js('/src/index.js', 'dist/index.js').vue();

mix.combine([
    'node_modules/primevue/resources/primevue.min.css',
    'node_modules/primevue/resources/themes/saga-blue/theme.css',
    'node_modules/primeflex/primeflex.css'
], 'dist/library.css');