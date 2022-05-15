import {createRouter, createWebHistory} from "vue-router";
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Articles from '../views/Articles.vue'

const routes =[
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/articles',
        name: 'Articles',
        component: Articles
    }
];


const router = createRouter({
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 };
    },
    history: createWebHistory(),
    routes,
    
})

export default router;