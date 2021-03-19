require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
import routes from './routes';
Vue.use(VueRouter);
Vue.component('NaviBar', require('./components/NaviBar').default);
Vue.component('PasswordReset',require('./vue_pages/PasswordReset').default);

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

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

