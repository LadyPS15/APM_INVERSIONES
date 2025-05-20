import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/index.css',
                'resources/css/login.css',
                'resources/css/dashboard.css',
                'resources/css/evaluacion.css',
                'resources/css/form.css',
                'resources/css/form_tecnico.css',
                'resources/css/form_metodologia.css',
                'resources/css/terms.css',
                'resources/css/eva_oficial.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
