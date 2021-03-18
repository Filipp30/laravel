require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
import routes from './routes';
Vue.use(VueRouter);
Vue.component('NaviBar', require('./components/NaviBar').default);
Vue.component('PasswordReset',require('./vue_pages/PasswordReset').default);
const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
});
Echo.channel('my-channel')
    .listen('my-event', (e) => {
        console.log(e)

    });
