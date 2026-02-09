import { defineConfig } from "vite";
import { resolve } from "path";

export default defineConfig(({ command }) => {
  const isProduction = command === "build";

  return {
    base: isProduction ? "/wp-content/themes/ellievate/" : "/",

    build: {
      manifest: true,
      outDir: "dist",
      emptyOutDir: true,
      rollupOptions: {
        input: {
          main: resolve(__dirname, "js/main.js"),
        },
        output: {
          entryFileNames: "js/[name].js",
          chunkFileNames: "js/[name]-[hash].js",
          assetFileNames: (assetInfo) => {
            if (assetInfo.name && assetInfo.name.endsWith(".css")) {
              return "css/[name][extname]";
            }
            return "assets/[name]-[hash][extname]";
          },
        },
      },
    },

    server: {
      host: "localhost",
      port: 3000,
      strictPort: true,
      cors: true,
      hmr: {
        host: "localhost",
        protocol: "ws",
      },
      watch: {
        include: ["css/**/*.css", "js/**/*.js"],
      },
    },

    publicDir: false,

    css: {
      devSourcemap: true,
    },
  };
});
