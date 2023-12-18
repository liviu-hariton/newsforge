import { createLogger, defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import path from 'path'

import basicSsl from '@vitejs/plugin-basic-ssl'

const logger = createLogger();
const originalWarning = logger.warn;
logger.warn = (msg, options) => {
    if (msg.includes('vite:css') && msg.includes(' is empty')) return;
    originalWarning(msg, options);
};

export default defineConfig({
    plugins: [
        laravel({
            input: [
                '/resources/js/frontend.js',
                '/resources/css/frontend.css',
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
    customLogger: logger,
});
