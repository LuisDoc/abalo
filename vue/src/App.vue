<template>
<div>
  <Navbar/>
  <router-view/>
  <Footer/>
</div>
</template>

<script>

import Navbar from "./components/Navbar.vue"
import Footer from "./components/Footer.vue"
  export default{
    components:{ Navbar, Footer }
  }
</script>


<style>
  @import '../css/app.css';
  * {
      font-family: 'Open Sans', sans-serif;
  }
</style>
