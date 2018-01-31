
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Laroute
import VueLaroute from 'vue-laroute';
import routes from '../../../public/js/laroute';
Vue.use(VueLaroute, {
    routes,
    accessor: '$routes', // Optional: the global variable for accessing the router
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// FRIENDS
Vue.component('add-friend', require('./components/Friends/AddFriendComponent.vue'));
Vue.component('cancel-request', require('./components/Friends/CancelRequestComponent.vue'));
Vue.component('confirm-request', require('./components/Friends/ConfirmRequestComponent.vue'));

const app = new Vue({
    el: '#app'
});


require('./bulma-extensions');
require('jquery');
