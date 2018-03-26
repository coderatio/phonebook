
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('materialize-css');

$(document).ready(function(){
    $('.sidenav').sidenav();
    $('select').formSelect();
});


window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

let Appheader = require('./components/AppHeader.vue');
let Appfooter = require('./components/AppFooter.vue');
let Home = require('./components/pages/Home.vue');
let About = require('./components/pages/About.vue');
let Index = require('./components/pages/Index.vue');

const routes = [
    { path: '/phonebook', component: Home },
    { path: '/about', component: About },
    { path: '/', component: Index }
];


let router = new VueRouter({
    routes // short for `routes: routes`
});

require('./routes/fronts');

const app = new Vue({
    el: '#app',
    router,
    components: {
        Appheader,
        Appfooter
    }
});
