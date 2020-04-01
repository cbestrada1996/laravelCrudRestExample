import Vue from 'vue'
import VueRouter from 'vue-router'
import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/antd.css';

Vue.use(VueRouter)
Vue.use(Antd)

import App from './views/App'
import Home from './views/Home'
import Items from './views/Items'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/items',
            name: 'items',
            component: Items
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});