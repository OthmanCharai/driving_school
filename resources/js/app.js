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
        .use(i18nVue, {
            resolve: async (lang) => {
                const langs = import.meta.glob("../../lang/*.json");
                return await langs[`../../lang/${lang}.json`]();
            },
        })
        .use(router)
        .use(pinia)
        .use(createPinia())
        .use(router)
        .use(layoutsPlugin)
        .use(i18n)
        .use(abilitiesPlugin, ability, {
            useGlobalProperties: true,
        });

    if (window.location.pathname.startsWith("/admin")) {
        app.use(vuetify);
    } else if (window.location.pathname != "/examResult") {
    }

    app.mount("#app");
};

setupApp();
