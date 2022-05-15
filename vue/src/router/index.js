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
    history: createWebHistory(),
    routes,
    
})

export default router;