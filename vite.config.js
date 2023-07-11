import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
const path = require('path') // <-- require path from node
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            // edit the first value of the array input to point to our new sass files and folder.
            input: ['resources/scss/app.scss', 'resources/js/app.js','resources/scss/appGuest.scss', 'resources/js/appGuest.js'],
            refresh: true,
        }),
        //to import vue on laravel
        vue({
            template:{
                transformAssetUrls:{
                    base: null,
                    includeAbsolute: false
                }
            }
        }),
    ],
    // Add resolve object and aliases
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~resources': '/resources/'
        }
    }
});
