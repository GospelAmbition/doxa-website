import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  root: resolve(__dirname, 'assets/styles'),
  base: './',
  build: {
    outDir: resolve(__dirname, 'assets/styles/dist'),
    emptyOutDir: true,
    rollupOptions: {
      input: resolve(__dirname, 'assets/styles/src/main.scss'),
      output: {
        assetFileNames: (assetInfo) => {
          if (assetInfo.name && assetInfo.name.endsWith('.css')) {
            return 'main.css';
          }
          return assetInfo.name || '[name].[ext]';
        },
      },
    },
    cssCodeSplit: false,
    sourcemap: process.env.NODE_ENV === 'development',
    minify: process.env.NODE_ENV === 'production',
    write: true,
  },
});
