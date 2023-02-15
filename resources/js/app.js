import './bootstrap';
// import style 
import './helpers/style'

import {createApp} from 'vue';
import { i18nVue } from 'laravel-vue-i18n';
import router from './routes/index'


 
import App from './App.vue';

import Landing from "./Pages/Landing/landing.vue";  


createApp(App).use(i18nVue, {
    resolve: async lang => {
        const langs = import.meta.glob('../../lang/*.json');
        return await langs[`../../lang/${lang}.json`]();
    }
})
.use(router)
.mount("#app")
