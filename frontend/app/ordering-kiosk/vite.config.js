import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import { VitePWA } from 'vite-plugin-pwa'
import compression from 'vite-plugin-compression'
// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    react(),
    VitePWA({
      manifest: {
        name: 'Camaya Kiosk',
        short_name: 'Kiosk',
        start_url: '/',
        display: 'standalone',
        background_color: '#ffffff',
        theme_color: '#000000',
        icons: [
          {
            src: '/public/vite.svg',
            sizes: '31.88x32',
            type: 'image/svg+xml',
          },
        ],
      },
      workbox: {
        skipWaiting: true,
        clientsClaim: true,
        runtimeCaching: [
          {
            urlPattern: /^https:\/\/fonts\.googleapis\.com/,
            handler: 'StaleWhileRevalidate',
            options: {
              cacheName: 'google-fonts-stylesheets',
            },
          },
        ],
      }
    }),
    compression({ algorithm: 'gzip' }),
  ],
  server: {
    host: true,
    port: 8026, // This is the port which we will use in docker
  },
  build: {
    minify: 'terser', // Minify the built files
    brotliSize: true, // Enable brotli compression size reporting
  },
})
