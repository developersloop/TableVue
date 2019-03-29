
require('./bootstrap');
import VModal from 'vue-js-modal';
import Vuex from 'vuex';
import getStore from '../js/store/index';
import vSelect from 'vue-select'
import VueResource from 'vue-resource';
import VueRouter from 'vue-router';
import routes from './routes/index';
window.Vue = require('vue');
window._ = require('lodash');

Vue.use(VModal, {componentName: "modal"});
Vue.use(Vuex);
Vue.use(VueResource); 
Vue.use(VueRouter);
Vue.component('example', require('./components/App/app.vue')); 
Vue.component('v-select', vSelect);
const router = new VueRouter({
    routes,
    mode:'history'
})
const store = getStore();


const app = new Vue({
    el: '#app',
    router,
    store
});
