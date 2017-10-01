
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
require('./base');
//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Toasted from 'vue-toasted';
import VueOccupy from 'vue-occupy';
Vue.use(VueOccupy);
Vue.use(Toasted);
//Vue.component('example', require('../components/Example.vue'));
Vue.component('user-avatar', require('./components/Avatar.vue'));
Vue.component('user-bookshelf', require('./components/Bookshelf.vue'));
Vue.component('user-info', require('./components/UserInfo.vue'));
Vue.component('user-bookinfobnt', require('./components/BookInfoBnt.vue'));
Vue.component('user-booknrbnt', require('./components/BookNrBnt.vue'));
Vue.component('user-jilu', require('./components/Jilu.vue'));
const app = new Vue({
    el: '#app'
});

require('./pjs');
