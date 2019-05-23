import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Routes from './router'
import VueSweetAlert from 'vue-sweetalert2'
import Mixin from './mixin'
import Axios from 'axios'
import VueAxios from 'vue-axios'
import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'
import Toasted from 'vue-toasted';
import moment from 'moment'
import VeeValidate from 'vee-validate'
import VueTable from 'vue-tables-2'
import VTooltip from 'v-tooltip'
import store from './stores/store'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'


Vue.config.productionTip = false
Vue.use(VueSweetAlert)
Vue.use(VueRouter)
Vue.use(VueAxios, Axios)
Vue.use(Toasted,{position:'top-center',fullWidth:true,duration:5000})
Vue.use(VeeValidate)
Vue.use(VueTable.ClientTable)
Vue.use(VTooltip)

const Routers = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: Routes,
})

Vue.router = Routers
Vue.store = store


App.router = Vue.router
App.store = Vue.store

Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
    // notFoundRedirect:{path:'/'},
    // authRedirect:{path:'/login'}
})

Axios.defaults.baseURL = "http://jumbara9jatim.info/api"


Vue.mixin(Mixin)

Vue.directive('focus',{
    inserted(el){
        el.focus()
    }
})

new Vue(App).$mount('#app');


// new Vue({
//   render: h => h(App)
// }).$mount('#app')