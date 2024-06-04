import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue2'

export default defineConfig({
  resolve: {
    alias: {
      vue: 'vue/dist/vue.js',
      '@': '/public/',
    },
  },
  server: {
    host: true,
    hmr: {
      host: 'localhost',
    },
  },
  plugins: [
    laravel({
      input: [
        'resources/assets/sass/app.scss',
        'resources/assets/sass/website/app.scss',
        'resources/assets/js/cms/app.js',
        'resources/assets/js/front/app.js',
      ],
      refresh: true,
    }),
    vue(),
  ],
})
