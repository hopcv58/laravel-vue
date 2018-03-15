import Vue from 'vue'
import VueRouter from 'vue-router'

import index from '../components/pages/Index'
import about from '../components/pages/About'
import users from '../components/pages/Users'
import login from '../components/pages/Login'
import product from '../components/pages/product/ProductList'
import productAdd from '../components/pages/product/ProductAdd'

Vue.use(VueRouter)

export default new VueRouter({
	mode: 'history',
	routes :
	[
		{
			path: '/',
			component: index,
			meta: {
				progress: {
					func: [
						{call: 'color', modifier: 'temp', argument: '#004cff'},
						{call: 'fail', modifier: 'temp', argument: '#6e0000'},
						{call: 'location', modifier: 'temp', argument: 'top'},
						{call: 'transition', modifier: 'temp', argument: {speed: '0.5s', opacity: '0.6s', termination: 400}}
					]
				}
			}
		},
		{
			path: '/about',
			component: about,
			meta: {
				progress: {
					func: [
						{call: 'color', modifier: 'temp', argument: '#004cff'},
						{call: 'fail', modifier: 'temp', argument: '#6e0000'},
						{call: 'location', modifier: 'temp', argument: 'top'},
						{call: 'transition', modifier: 'temp', argument: {speed: '0.5s', opacity: '0.6s', termination: 400}}
					]
				}
			}
		},
		{
			path: '/users',
			component: users,
			meta: {
				progress: {
					func: [
						{call: 'color', modifier: 'temp', argument: '#004cff'},
						{call: 'fail', modifier: 'temp', argument: '#6e0000'},
						{call: 'location', modifier: 'temp', argument: 'top'},
						{call: 'transition', modifier: 'temp', argument: {speed: '0.5s', opacity: '0.6s', termination: 400}}
					]
				}
			}
		},
		{
			path: '/product',
			component: product,
			meta: {
				progress: {
					func: [
						{call: 'color', modifier: 'temp', argument: '#004cff'},
						{call: 'fail', modifier: 'temp', argument: '#6e0000'},
						{call: 'location', modifier: 'temp', argument: 'top'},
						{call: 'transition', modifier: 'temp', argument: {speed: '0.5s', opacity: '0.6s', termination: 400}}
					]
				}
			}
		},
		{
			path: '/product/add',
			component: productAdd,
			meta: {
				progress: {
					func: [
						{call: 'color', modifier: 'temp', argument: '#004cff'},
						{call: 'fail', modifier: 'temp', argument: '#6e0000'},
						{call: 'location', modifier: 'temp', argument: 'top'},
						{call: 'transition', modifier: 'temp', argument: {speed: '0.5s', opacity: '0.6s', termination: 400}}
					]
				}
			}
		},
		{
			path: '/login',
			component: login,
			meta: {
				progress: {
					func: [
						{call: 'color', modifier: 'temp', argument: '#004cff'},
						{call: 'fail', modifier: 'temp', argument: '#6e0000'},
						{call: 'location', modifier: 'temp', argument: 'top'},
						{call: 'transition', modifier: 'temp', argument: {speed: '0.5s', opacity: '0.6s', termination: 400}}
					]
				}
			}
		}
	]
})