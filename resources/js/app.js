import "./bootstrap";

/* eslint-disable import/order */
import "@/@fake-db/db";
import "@/@iconify/icons-bundle";
import App from "@/App.vue";
import AdminApp from "@/AdminApp.vue";
import ability from "@/plugins/casl/ability";
import i18n from "@/plugins/i18n";
import layoutsPlugin from "@/plugins/layouts";
import vuetify from "@/plugins/vuetify";
import { loadFonts } from "@/plugins/webfontloader";
import router from "@/router";
import { abilitiesPlugin } from "@casl/vue";
import { createPinia } from "pinia";
import { createApp } from "vue";
import { i18nVue } from "laravel-vue-i18n";
// import I18nVue from "./@core/components/I18n.vue";

loadFonts();
const pinia = createPinia();

const setupApp = async () => {
    // Use plugins
    const app = createApp(
        window.location.pathname.startsWith("/admin") ? AdminApp : App
    )
        .use(router)
        .use(pinia)
        .use(createPinia())
        .use(router)
        .use(layoutsPlugin)
        .use(abilitiesPlugin, ability, {
            useGlobalProperties: true,
        });

    if (window.location.pathname.startsWith("/admin")) {
        app.use(i18n);
        app.use(vuetify);
    } else {
        app.use(i18nVue, {
            resolve: async (lang) => {
                const langs = import.meta.glob("../../lang/*.json");
                return await langs[`../../lang/${lang}.json`]();
            },
        });
    }
    app.mount("#app");
};

setupApp();
