import "./bootstrap";

/* eslint-disable import/order */
import "@/@fake-db/db";
import "@/@iconify/icons-bundle";
import App from "@/App.vue";
import ability from "@/plugins/casl/ability";
import i18n from "@/plugins/i18n";
import layoutsPlugin from "@/plugins/layouts";
import vuetify from "@/plugins/vuetify";
import { loadFonts } from "@/plugins/webfontloader";
import router from "@/router";
import { abilitiesPlugin } from "@casl/vue";
import "@/@core/scss/template/index.scss";
import "@/styles/styles.scss";
import { createPinia } from "pinia";
import { createApp } from "vue";
import I18nVue from "./@core/components/I18n.vue";

loadFonts();
const pinia = createPinia();

const setupApp = async () => {
    if (window.location.href === "examResult") {
        // await import("@/helpers/style");
    }


    // Use plugins
    createApp(App)
        .use(I18nVue, {
            resolve: async (lang) => {
                const langs = import.meta.glob("../../lang/*.json");
                return await langs[`../../lang/${lang}.json`]();
            },
        })
        .use(router)
        .use(pinia)
        .use(vuetify)
        .use(createPinia())
        .use(router)
        .use(layoutsPlugin)
        .use(i18n)
        .use(abilitiesPlugin, ability, {
            useGlobalProperties: true,
        })
        .mount("#app");
};

setupApp();
