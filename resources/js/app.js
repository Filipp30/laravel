require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
import routes from './routes';
Vue.use(VueRouter);
Vue.component('NaviBar', require('./components/NaviBar').default);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
});
