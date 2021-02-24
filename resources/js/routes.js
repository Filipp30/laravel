import Home from './vue_pages/Home';
import Auth from './vue_pages/Auth';
import Contact from './vue_pages/Contact';
import NotFound from "./vue_pages/NotFound";

export default{
    mode: 'history',
    // linkActiveClass: 'font-semibold',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/auth',
            name: 'Auth',
            component: () => import('./vue_pages/Auth.vue')
        },
        {
            path: '/contact',
            name: 'Contact',
            component: () => import('./vue_pages/Contact.vue')
        }

    ]

}
