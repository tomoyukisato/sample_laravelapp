
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
Vue.use(Vuetify);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('fullcalendar', require('./components/FullCalendar.vue'));
Vue.component('calendar', require('./components/Calendar.vue'));
Vue.component('app-header', require('./components/Header.vue'));
Vue.component('memo-list', require('./components/MemoList.vue'));


const app = new Vue({
    el: '#app',  
    vuetify: new Vuetify()
});

