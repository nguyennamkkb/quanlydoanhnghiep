import Vue from "vue"
import Router from 'vue-router'
// import { component } from "vue/types/umd"
const homeapp = '/home'
const dashboardapp = '/dashboard'

Vue.use(Router)

import dashboard from './asset/views/dashboard/index.vue';
import home from './asset/views/home/index.vue';

const routes = [
    // dashboard
    {
        path: homeapp,
        component: dashboard,
        children: [{
                path: dashboardapp + '/user',
                component: () =>
                    import ('./asset/views/dashboard/user/index.vue'),
                name: 'User'
            },
            {
                path: dashboardapp + '/code',
                component: () =>
                    import ('./asset/views/dashboard/code/index.vue'),
                mnameeta: 'Code'
            
            },
            {
                path: dashboardapp + '/QR',
                component: () =>
                    import ('./asset/views/dashboard/QRCode/index.vue'),
                    name: 'QRCode'
            }
        ]
    },
    { // home
        path: homeapp,
        component: home,
        name: 'home',
        children: [{
            path: homeapp + '/auth',
            component: () =>
                import ('./asset/views/home/auth.vue'),
            meta: 'auth',
            name: 'auth'
        }]
    }

]

export default new Router({
    mode: 'history',
    routes
})