import {createRouter, createWebHistory} from "vue-router";
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/Auth/LoginView.vue'
import RegisterView from '../views/Auth/RegisterView.vue'
import ArticlesView from '../views/ArticlesView.vue'
import SettingsView from '../views/Cookies/SettingsView.vue'
import GuidelinesView from  '../views/Cookies/GuidelinesView.vue'

const routes =[
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
    {
        path: '/',
        name: 'Home',
        component: HomeView
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

export default router;