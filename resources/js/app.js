import './bootstrap';
// import style 
import './helpers/style'


import {createApp} from 'vue'
import { i18nVue } from 'laravel-vue-i18n'
 
import App from './App.vue'

import Landing from "./Components/Landing/landing.vue"



createApp(Landing).use(i18nVue, {
    resolve: async lang => {
        const langs = import.meta.glob('../../lang/*.json');
        return await langs[`../../lang/${lang}.json`]();
    }
})

.mount("#app")
