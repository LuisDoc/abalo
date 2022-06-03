<template>
<div>
  <Navbar/>
  <router-view :cookie="cookie" :promote="promote"/>
  <Footer/>
  <CookieCheck @cookieevent="cookieSettings"/>
</div>
</template>

<script>

import Navbar from "./components/Navbar.vue"
import Footer from "./components/Footer.vue"
import CookieCheck from "./components/CookieCheck.vue"
import { useToast } from "vue-toastification";
import {mapState} from 'vuex'
export default{
  emits:["promote"],
  setup(){
    const toast = useToast();
    return {toast}
  },
  components:{ Navbar, Footer ,CookieCheck},
  data(){
    return{
      cookie :true,
    }
  },  
  methods:{
    cookieSettings(settings){
      this.cookie = settings;
      window.sessionStorage.setItem("acceptCookies", this.cookie);
    },
    start() {
        this.$confetti.start();
        setTimeout(() => {
            this.$confetti.stop();
        }, 3500);
        
    },
  },
  computed:{
        ...mapState(['user'])
  },
  mounted(){
    /*
    Echo.channel('Hello')
    .listen('HelloWebsocket', (e)=>{
        console.log(e);
    });*/
    const toast =  this.toast;
    Echo.channel('Maintenance')
    .listen('Maintenance', function(e){
        toast.warning(e.message);
    });
    const user = this.user;
    Echo.channel('Sale')
    .listen('Sold', function(e){
      if(user && user.data.id == e.userid){
        toast.success(e.message);
      }
    });

    const router = this.$router;
    const start = this.start;
    Echo.channel('Promotion')
    .listen('Promotion', function(e){
      let article = JSON.parse(e.article)
      if(router.currentRoute._value.path == "/article/"+article.id){
         toast.error(e.message);
         start();
      }
    });
  }
}
</script>


<style>
 
</style>
