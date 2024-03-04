import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/components/map.css',
                'resources/css/components/sidenavbar.css',
                'resources/js/app.js',
                'resources/js/components/map.js',
                'resources/js/components/sidenavbar.js',
            ],
            refresh: true,
        }),
    ],
});
