import {createRouter, createWebHistory} from "vue-router";
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/Auth/LoginView.vue'
import RegisterView from '../views/Auth/RegisterView.vue'
import ArticlesView from '../views/ArticlesView.vue'
import SettingsView from '../views/Cookies/SettingsView.vue'
import GuidelinesView from  '../views/Cookies/GuidelinesView.vue'
import AuthLayout from  '../components/AuthLayout.vue'
import ImpressumView from "../views/ImpressumView.vue"
import store from "../store";
import ShoppingcartView from "../views/ShoppingcartView.vue"
import MyArticlesView from "../views/MyArticlesView.vue"
import AddNewArticlesView from "../views/AddNewArticlesView.vue"
import ExampleComponentView from "../views/ExampleComponentView.vue"
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
    },
    {
        path: '/impressum',
        name: 'Impressum',
        component:ImpressumView 
    },
    {
        path:"/shoppingcart",
        name:"Cart",
        component: ShoppingcartView,
        meta:{requiresAuth:true}
    },
    {
        path:"/myArticles",
        name:"MyArticles",
        component: MyArticlesView,
        meta:{requiresAuth:true}
    },
    {
        path:"/newarticle",
        name:"NewArticle",
        component:AddNewArticlesView,
        meta:{requiresAuth:true}
    },
    {
        path:"/example",
        name: "Example",
        component: ExampleComponentView
    }
];


const router = createRouter({
    history: createWebHistory(),
    routes,
    
})

//Umsetzung einer Middleware-Weiterleitung
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