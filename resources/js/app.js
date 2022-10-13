require('./bootstrap');

const feather = require('feather-icons')

feather.replace();

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'


Vue.use(Vuetify)


import User from "./components/Helpers/User";
window.User = User


Vue.component('app-home',require('./components/AppHome.vue').default);

import router from './Router/router.js'
const app = new Vue({
    vuetify : new Vuetify(),
    el: "#app",
    router,
})



export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: '#3f51b5',
                secondary: '#696969',
                accent: '#8c9eff',
                error: '#b71c1c',
            },
        },
    },
})
