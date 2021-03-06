import Vue from 'vue'
import VueRouter from 'vue-router'
import { BootstrapVue } from 'bootstrap-vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faCheck, faPlus } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import VueSweetalert2 from 'vue-sweetalert2'

library.add(faCheck, faPlus)

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import '../sass/app.scss'
import 'sweetalert2/dist/sweetalert2.min.css'
import TMTaskForm from "./components/TMTaskForm";
import TMInitialMenu from "./components/TMInitialMenu";
import TMTaskTypeForm from "./components/TMTaskTypeForm"
import TMTaskList from "./components/TMTaskList"
import TMTaskTypeList from "./components/TMTaskTypeList";

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
Vue.use(VueRouter)
Vue.use(VueSweetalert2)

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('font-awesome-icon', FontAwesomeIcon)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'default',
            component: TMInitialMenu,
        },
        {
            path: '/tasks-list',
            name: 'task-list',
            component: TMTaskList,
        },
        {
            path: '/register',
            name: 'register',
            component: TMTaskForm,
        },
        {
            path: '/task-type-list',
            name: 'task-type-list',
            component: TMTaskTypeList,
        },
        {
            path: '/edit-task/:id',
            name: 'edit-task',
            component: TMTaskForm,
        },
        {
            path: '/register-type',
            name: 'register-task-type',
            component: TMTaskTypeForm,
        },
        {
            path: '/edit-task-type/:id',
            name: 'edit-task-type',
            component: TMTaskTypeForm,
        },
    ],
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
