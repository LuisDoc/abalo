import {createRouter, createWebHistory} from "vue-router";
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/Auth/LoginView.vue'
import RegisterView from '../views/Auth/RegisterView.vue'
import ArticlesView from '../views/ArticlesView.vue'
import SettingsView from '../views/Cookies/SettingsView.vue'
import GuidelinesView from  '../views/Cookies/GuidelinesView.vue'
import AuthLayout from  '../components/AuthLayout.vue'
import store from "../store";

const routes =[
    
    {
        path: '/',
        name: 'Home',
        component: HomeView
    },
    {
        path: '/auth',
        name: 'Auth',
        redirect: '/login',
        component: AuthLayout,
        children:[
            {
                path: '/login',
                name: 'Login',
                component: LoginView
            },
            {
                path: '/register',
                name: 'Register',
                component: RegisterView
            },
        ]

    },
    {
        path: '/articles',
        name: 'Articles',
        component: ArticlesView
    },
    {
        path: '/cookieguidelines',
        name: 'Cookies',
        component: GuidelinesView
    },
    {
        path: '/cookiesettings',
        name: 'Settings',
        component: SettingsView
    }
];


const router = createRouter({
    history: createWebHistory(),
    routes,
    
})

router.beforeEach((to, from, next)=>{
    if(to.meta.requiresAuth && !store.state.user.token){
        next({name:'Login'});
    }else if(store.state.user.token && (to.name==='Login' ||to.name==='Register')) {
        next({name: 'Home'});
    }else{
        next();
    }
})

export default router;