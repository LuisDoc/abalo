<template>
<div>
  <Navbar/>
  <router-view :cookie="cookie" :promote="promote" :discount="discount"/>
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
      discount: false
    }
  },  
  methods:{
    cookieSettings(settings){
      this.cookie = settings;
      window.sessionStorage.setItem("acceptCookies", this.cookie);
    },
      start(e) {
          this.toast.error(e.message);
          this.discount = !this.discount;
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

    const router = this.$router;
    const start = this.start;
    Echo.channel('Promotion')
    .listen('Promotion', function(e){
        let article = JSON.parse(e.article)
        if(router.currentRoute._value.path == "/article/"+article.id){
            start(e);
        }
    })
  }
}
</script>


<style>
 
</style>
