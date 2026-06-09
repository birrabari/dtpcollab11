import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/global.css',
                'resources/css/components/sidebar.css',
                'resources/css/components/theme.css',
                'resources/css/pages/welcome.css',
                'resources/css/pages/schedule.css',
                'resources/css/pages/profile.css',
                'resources/css/pages/auth.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
