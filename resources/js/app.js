/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import store from './store'

Vue.component('App', require('./App.vue').default);

Vue.use(require('vue-moment'));

const app = new Vue({
    el: '#app',
    store
});
