import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/config.js', 'resources/js/artist.js', "resources/js/album.js" , 'resources/css/font-awesome.min.css'],
            refresh: true,
        }),
    ],
});
