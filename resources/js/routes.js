import Home from './vue_pages/Home';
import ProductForum from "./vue_pages/ProductForum";
import Auth from './vue_pages/Auth';
import Contact from './vue_pages/Contact';
import NotFound from "./vue_pages/NotFound";

export default{
    mode: 'history',
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
            path: '/product-forum',
            name: 'ProductForum',
            component: () => import('./vue_pages/ProductForum'),
            beforeEnter:(to,form,next)=>{
                axios.get('api/authenticated').then(()=>{
                    next()
                }).catch(()=>{
                    return next({name: 'Auth'})
                })
            }
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
