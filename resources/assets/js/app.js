
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');


window.$.fn.dataTable = require('datatables.net-bs4');
window.basictable = require('basictable');
window.select2 = require('select2');
window.mask = require('jquery-mask-plugin');

window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('item-list-component', require('./components/ItemListComponent.vue'));
Vue.component('notification-navbar-component', require('./components/NotificationNavbarComponent.vue'));
Vue.component('span-component', require('./components/SpanComponent.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready(function() {
    $('select').select2({
        dir: "rtl",
        language: "fa"
    });
    $('table').basictable();
});
