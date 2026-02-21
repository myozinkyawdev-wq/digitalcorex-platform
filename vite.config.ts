import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.tsx'],
            ssr: 'resources/js/ssr.tsx',
            refresh: true,
        }),
        react({
            babel: {
                plugins: ['babel-plugin-react-compiler'],
            },
        }),
        tailwindcss(),
        wayfinder({
            formVariants: true,
        }),
    ],
    esbuild: {
        jsx: 'automatic',
    },
    server: {
        // ngrok ကနေ လှမ်းဆွဲတာကို ခွင့်ပြုဖို့ CORS ကို true ပေးရမယ်
        cors: true,
        strictPort: true,
        // ngrok URL ကို trusted host အဖြစ် သတ်မှတ်ပေးရမယ်
        hmr: {
            host: 'miserable-trothless-loree.ngrok-free.dev',
            protocol: 'wss', // Secure WebSocket သုံးဖို့ပြောတာ
        },
    },
});
