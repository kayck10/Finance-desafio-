import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    vue(),
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'finance-frontend/src'),
      'vue': 'vue/dist/vue.esm-bundler.js',
    },
  },
  build: {
    outDir: path.resolve(__dirname, 'public/build'),
  },
});
