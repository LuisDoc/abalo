import { createApp } from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'

import Echo from 'laravel-echo'
import Pusher from "pusher-js"

import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

window.Pusher = Pusher;



window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_APP_WEBSOCKETS_KEY,
    wsHost: import.meta.env.VITE_APP_WEBSOCKETS_SERVER,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true
})




createApp(App)
    .use(store)
    .use(router)
    .use(Toast)
    .mount('#app')
