import { createApp } from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'
import VueConfetti from 'vue-confetti'
import Echo from 'laravel-echo'
import Pusher from "pusher-js"
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";
import ApolloClient  from 'apollo-boost';
import { createApolloProvider } from '@vue/apollo-option'

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_APP_WEBSOCKETS_KEY,
    wsHost: import.meta.env.VITE_APP_WEBSOCKETS_SERVER,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
})

const apolloClient = new ApolloClient({
  // You should use an absolute URL here
  uri: 'http://127.0.0.1:8000/graphql',
})

const apolloProvider = createApolloProvider({
  defaultClient: apolloClient,
})


createApp(App)
  .use(store)
  .use(router)
  .use(VueConfetti)
  .use(Toast)
  .use(apolloProvider)
  .mount('#app')

