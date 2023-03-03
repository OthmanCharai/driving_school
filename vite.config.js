import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import i18n from "laravel-vue-i18n/vite";
import { fileURLToPath } from "url";
import VueI18n from "@intlify/vite-plugin-vue-i18n";
import vueJsx from "@vitejs/plugin-vue-jsx";
import AutoImport from "unplugin-auto-import/vite";
import Components from "unplugin-vue-components/vite";
import DefineOptions from "unplugin-vue-define-options/vite";
import Pages from "vite-plugin-pages";
import Layouts from "vite-plugin-vue-layouts";
import vuetify from "vite-plugin-vuetify";

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.js",
            refresh: true,
        }),
        i18n(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
            script: {
                refSugar: true,
            },
        }),
        vueJsx(),

        // https://github.com/vuetifyjs/vuetify-loader/tree/next/packages/vite-plugin
        vuetify({
            styles: {
                configFile: "resources/js/styles/variables/_vuetify.scss",
            },
        }),
        Pages({
            dirs: ["./resources/js/pages"],

            // ℹ️ We need three routes using single routes so we will ignore generating route for this SFC file
            onRoutesGenerated: (routes) => [
                // Email filter
                {
                    path: "/admin/email/:filter",
                    name: "admin-email-filter",
                    component: "/resources/js/pages/admin/email/index.vue",
                    meta: {
                        navActiveLink: "admin-email",
                        layoutWrapperClasses: "layout-content-height-fixed",
                    },
                },

                // Email label
                {
                    path: "/admin/email/label/:label",
                    name: "admin-email-label",
                    component: "/resources/js/pages/admin/email/index.vue",
                    meta: {
                        // contentClass: 'email-application',
                        navActiveLink: "admin-email",
                        layoutWrapperClasses: "layout-content-height-fixed",
                    },
                },
                ...routes,
            ],
        }),
        Layouts({
            layoutsDirs: "./resources/js/layouts/",
        }),
        Components({
            dirs: ["resources/js/@core/components", "resources/js/views/demos"],
            dts: true,
        }),
        AutoImport({
            eslintrc: {
                enabled: true,
                filepath: "./.eslintrc-auto-import.json",
            },
            imports: [
                "vue",
                "vue-router",
                "@vueuse/core",
                "@vueuse/math",
                "vue-i18n",
                "pinia",
            ],
            vueTemplate: true,
            // targets to transform
            // include: [
            //     /\.vue\??/, // .vue
            // ],
        }),
        VueI18n({
            runtimeOnly: true,
            compositionOnly: true,
            include: [
                fileURLToPath(
                    new URL(
                        "./resources/js/plugins/i18n/locales/**",
                        import.meta.url
                    )
                ),
            ],
        }),
        DefineOptions(),
    ],
    define: { "process.env": {} },
    resolve: {
        alias: {
            "@": fileURLToPath(new URL("./resources/js", import.meta.url)),
            "@themeConfig": fileURLToPath(
                new URL("./themeConfig.js", import.meta.url)
            ),
            "@core": fileURLToPath(
                new URL("./resources/js/@core", import.meta.url)
            ),
            "@layouts": fileURLToPath(
                new URL("./resources/js/@layouts", import.meta.url)
            ),
            "@images": fileURLToPath(
                new URL("./resources/js/assets/images/", import.meta.url)
            ),
            "@styles": fileURLToPath(
                new URL("./resources/js/styles/", import.meta.url)
            ),
            "@configured-variables": fileURLToPath(
                new URL(
                    "./resources/js/styles/variables/_template.scss",
                    import.meta.url
                )
            ),
            "@axios": fileURLToPath(
                new URL("./resources/js/plugins/axios", import.meta.url)
            ),
            "@validators": fileURLToPath(
                new URL(
                    "./resources/js/@core/utils/validators",
                    import.meta.url
                )
            ),
            apexcharts: fileURLToPath(
                new URL("node_modules/apexcharts-clevision", import.meta.url)
            ),
        },
    },
    build: {
        chunkSizeWarningLimit: 5000,
    },
    optimizeDeps: {
        exclude: ["vuetify"],
        entries: ["./resources/js/**/*.vue"],
    },
});
