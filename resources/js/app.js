/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
import Homepage from './components/Homepage.vue'
import Read from './components/Read.vue'
import Create from './components/Create.vue'
import Update from './components/Update.vue'

Vue.use(VueRouter);

Vue.component('pagination', require('laravel-vue-pagination')); //for pagination

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/admin/dashboard',
            name: 'read',
            component: Read,
            props: true
        },
        {
            path:'/admin/create',
            name:'create',
            component: Create,
            props: true
        },
        {
            path:'/admin/update',
            name:'update',
            component: Update,
            props: true
        },
    ],
});


const app = new Vue({
    el: '#app',
    router,
    components: {Homepage}
});
