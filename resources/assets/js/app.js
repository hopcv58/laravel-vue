require('./bootstrap');

import Vue from 'vue'
import router from './router'
import i18n from './lang/i18n'
import Vuex from 'vuex'
import store from './store'
import VueSweetalert2 from 'vue-sweetalert2';
import App from './components/App'

Vue.use(Vuex)
Vue.use(VueSweetalert2);

const app = new Vue({
	el: '#app',
	i18n,
	router,
	store,
	render: h => h(App)
})

export default app