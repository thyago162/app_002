import Vue from 'vue'
import Router from 'vue-router'

import Home from '../view/Home'
import Loja from '../view/Loja'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home,
            name: 'home'
        },
        {
            path: '/loja',
            component: Loja,
            name: 'loja'
        }
    ]
})
