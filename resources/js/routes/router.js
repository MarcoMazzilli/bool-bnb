import {createRouter, createWebHistory } from 'vue-router';
import home from '../pages/home.vue';
import advancedSearch from '../pages/advanced-search.vue';
import apartment from '../pages/apartment.vue';

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: home,
            meta
        },
        {
            path: '/search',
            name: 'advancedSearch',
            component: advancedSearch,
            meta
        },
        {
            path: '/apartment/:slug',
            name: 'apartment',
            component: apartment,
            meta
        },
    ]
})


export {router};
