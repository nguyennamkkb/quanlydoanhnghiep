require('./bootstrap');

// window.Vue = require('vue')
import Vue from 'vue';
import router from './router'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);


// Vue.component('homeapp', require('./components/mainapp.vue'));
Vue.component('Dashboardapp', require('./asset/views/dashboard/dashboard.vue').default);
const app = new Vue({
    el: '#app',
    router,

})