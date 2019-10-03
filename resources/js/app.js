require('./bootstrap');

window.Vue = require('vue');

Vue.component('articles', require('./components/Articles.vue').default);
Vue.component('chat-app', require('./components/ChatApp.vue').default);
Vue.component('message-notice', require('./components/MessageNotice.vue').default);

// const app = new Vue({
//     el: '#app',
// });


