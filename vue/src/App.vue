<template>
<div>
  <Navbar/>
  <router-view :cookie="cookie"/>
  <Footer/>
  <CookieCheck @cookieevent="cookieSettings"/>
</div>
</template>

<script>

import Navbar from "./components/Navbar.vue"
import Footer from "./components/Footer.vue"
import CookieCheck from "./components/CookieCheck.vue"
  export default{
    components:{ Navbar, Footer ,CookieCheck},
    data(){
      return{
        cookie :true
      }
    },  
    methods:{
      cookieSettings(settings){
        this.cookie = settings;
        window.sessionStorage.setItem("acceptCookies", this.cookie);
      }
    },
    mounted(){
      Echo.private('Hello')
      .listen('HelloWebsocket', (e)=>{
          console.log("Check");
          console.log(e);
      });
    }
  }
</script>


<style>
 
</style>
