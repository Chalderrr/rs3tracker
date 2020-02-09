require('./bootstrap');
window.Vue = require('vue');

Vue.component('search-component', require('./components/Search.vue').default);

const app = new Vue({
    el: '#app'
});