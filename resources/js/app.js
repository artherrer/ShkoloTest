/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Sweet Alert Dependence
 */
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
import 'sweetalert2/dist/sweetalert2.min.css';


/**
 * Font Awesom icons dependences
 */
import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { faSave, faEdit, faTrash, faPlusCircle, faLink } from '@fortawesome/free-solid-svg-icons';

// We are only using the user-astronaut icon
library.add(faSave);
library.add(faEdit);
library.add(faTrash);
library.add(faTrash);
library.add(faPlusCircle);
library.add(faLink);

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
Vue.component('font-awesome-icon', FontAwesomeIcon);

// Replace any existing <i> tags with <svg> and set up a MutationObserver to
// continue doing this as the DOM changes.
dom.watch();


/**
 * VueToggle Button dependence
 */
import ToggleButton from 'vue-js-toggle-button';
Vue.use(ToggleButton);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
