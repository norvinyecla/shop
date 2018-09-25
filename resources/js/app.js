
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

<<<<<<< HEAD
Vue.component('product-list', require('./components/ProductList.vue'))
Vue.component('product-form', require('./components/ProductForm.vue'))
=======
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('product-list', require('./components/ProductList.vue'));
Vue.component('product-form', require('./components/ProductForm.vue'));
Vue.component('product-edit-form', require('./components/ProductEditForm.vue'));

>>>>>>> master

const app = new Vue({
    el: '#app'
});
