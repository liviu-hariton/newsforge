import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import path from 'path'

import basicSsl from '@vitejs/plugin-basic-ssl'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/frontend.js',
                'resources/css/frontend.css',
            ],
            resolve: {
                alias: {
                    '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
                }
            },
            refresh: true,
        }),
        basicSsl()
    ],
    define: {
        _global: ({}),
    },
});
