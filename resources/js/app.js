import './bootstrap';
// import style 
import './helpers/style'


import {createApp} from 'vue'
import VueSlick from 'vue-slick'


import App from './App.vue'

import Landing from "./Components/Landing/landing.vue"



createApp(Landing)

.mount("#app")
