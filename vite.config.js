import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/product/card.css',
                'resources/css/customer/header.css',
                'resources/js/cutsomer/header.jsx',
                'resources/js/product/card.jsx',
                'resources/js/app.js',
                'resources/css/customer/auth.signin.css',
                'resources/css/customer/auth.css',
                'resources/css/seller/auth.css',
                'resorces/js/seller/personal.jsx',
                ],
            refresh: true,
        }),
        react()
    ],
});
