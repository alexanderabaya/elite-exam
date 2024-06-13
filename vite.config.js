import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
    resolve: {
        alias: [
            {
                find: /^~(.*)$/,
                replacement: '$1',
            },
        ],
        aliases: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap')
        }
    }
});
