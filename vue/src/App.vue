<template>
<div>
  <Navbar/>
  <router-view/>
  <Footer/>
  <CookieCheck @AcceptCookie="setRefs"/>
</div>
</template>

<script>

import Navbar from "./components/Navbar.vue"
import Footer from "./components/Footer.vue"
import CookieCheck from "./components/CookieCheck.vue"
  export default{
    components:{ Navbar, Footer ,CookieCheck},
    methods:{
      setRefs(settings){
        console.log(settings);
      }
    }
  }
</script>


<style>
 
</style>
