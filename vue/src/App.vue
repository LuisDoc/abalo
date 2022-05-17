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
        console.log(settings)
        this.cookie = settings;
      }
    }
  }
</script>


<style>
 
</style>
