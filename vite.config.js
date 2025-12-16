import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  base: './',
  build: {
    outDir: resolve(__dirname, 'assets/dist'),
    emptyOutDir: true,
    modulePreload: false,
    rollupOptions: {
      input: [
        resolve(__dirname, 'assets/styles/src/main.scss'),
        resolve(__dirname, 'js/components/src/main.ts'),
      ],
      output: {
        entryFileNames: `[name].js`,
        chunkFileNames: `[name].js`,
        assetFileNames: `[name].[ext]`,
      },
    },
    cssCodeSplit: false,
    sourcemap: process.env.NODE_ENV === 'development',
    minify: process.env.NODE_ENV === 'production',
    write: true,
  },
});
