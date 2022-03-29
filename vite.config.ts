import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

const cwd = process.cwd();

// https://vitejs.dev/config/
export default defineConfig({
  // root: `${cwd}/cliente`,
  build: {
    // outDir: `${cwd}/public`,
    manifest: true,
    rollupOptions: {
      input: `${cwd}/cliente/main.ts`,
    },
  },
  server: {
    cors: true,
  },

  plugins: [vue()],
});
