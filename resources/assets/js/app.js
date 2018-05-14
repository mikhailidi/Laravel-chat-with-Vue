
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Buefy from 'buefy'

Vue.use(Buefy);

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
Vue.component('add-friend', require('../../../Modules/Friend/Resources/assets/js/components/AddFriendComponent.vue'));
Vue.component('cancel-request', require('../../../Modules/Friend/Resources/assets/js/components/CancelRequestComponent.vue'));
Vue.component('confirm-request', require('../../../Modules/Friend/Resources/assets/js/components/ConfirmRequestComponent.vue'));
Vue.component('chat', require('../../../Modules/Chat/Resources/assets/js/components/Chat.vue'));
Vue.component('conversations', require('../../../Modules/Chat/Resources/assets/js/components/Conversation.vue'));

Vue.prototype.$eventBus = new Vue();

const app = new Vue({
    el: '#app'
});


require('./bulma-extensions');
require('jquery');
