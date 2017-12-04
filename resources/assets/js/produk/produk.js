require('./../bootstrap');

window.Vue = require('vue');

const _http = axios.create({
  	baseURL: 'http://localhost:8000/api/produk',
});

Vue.prototype.$http = _http
Vue.config.productionTip = false

import App from './component/App.vue'

import VueRouter from 'vue-router'
Vue.use(VueRouter)
import router from './router.js'

import store from './store/index'

//Plugin sweetalert2
const swal = require('sweetalert2')
const swalPlugin = {}
swalPlugin.install = function(Vue){
	Vue.prototype.$swal = swal
}
Vue.use(swalPlugin)

const app = new Vue({
    el: '#root',
    template: '<app></app>',
    components: { App },
    router,
    store,
});
