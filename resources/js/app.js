import "./bootstrap";

import { createApp } from "vue";
import { i18nVue } from "laravel-vue-i18n";
import router from "./routes/index";
import { createPinia } from "pinia";

import App from "./App.vue";


const pinia = createPinia();

createApp(App)
    .use(i18nVue, {
        resolve: async (lang) => {
            const langs = import.meta.glob("../../lang/*.json");
            return await langs[`../../lang/${lang}.json`]();
        },
    })
    .use(router)
    .use(pinia)
    .mount("#app");
