import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  server: {
    proxy: {
      '/api': { // Svi API zahtevi koji počinju sa /api će biti prosleđeni na backend
        target: 'http://localhost:8000', // Laravel backend URL
        changeOrigin: true,
        secure: false
      }
    }
  }
});