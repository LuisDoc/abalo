import { createApp } from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'

import Echo from 'laravel-echo'
import Pusher from "pusher-js"

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_APP_WEBSOCKETS_KEY,
    wsHOST: import.meta.env.VITE_APP_WEBSOCKETS_SERVER,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true
})




createApp(App)
    .use(store)
    .use(router)
    .mount('#app')
