require('./bootstrap');

window.Vue = require('vue').default;
window.Pusher = require('pusher-js');

import VueRouter from 'vue-router';
import routes from './routes';
import Echo from 'laravel-echo';
import VueChatScroll from 'vue-chat-scroll';

Vue.use(VueRouter);
Vue.use(VueChatScroll);
Vue.component('NaviBar', require('./components/NaviBar').default);
Vue.component('PasswordReset',require('./vue_pages/PasswordReset').default);

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: false,
    encrypted: false
});
const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),

});

