<template>
 <div class ="mx-20 my-32">
    <h1 class="firstHeadline">Cookie Einstellungen</h1>
    <div class="mx-64 rounded-xl mt-32">
        <div class ="flex justify-center  mb-32">
            <button @click="setCookie(true)" id="btnAcceptCookies" class="text-white p-4 border-2 hover:border-purple rounded-full mr-2 hover:bg-white " :class ="[cookie==true? 'bg-white text-green-600 hover:bg-green-600 hover:text-white': 'bg-green-600 hover:text-green-600']">Cookies aktivieren</button>
            <button @click="setCookie(false)" id="btnAcceptCookies" class="text-white p-4 border-2 hover:border-purple rounded-full mr-2 hover:bg-white" :class ="[cookie!=true? 'bg-white text-red-600 hover:bg-red-600 hover:text-white': 'bg-red-600 hover:text-red-600']">Cookies deaktivieren</button>
        </div>
        <div class="flex justify-center">
            <router-link class ="underline rounded-full p-5 hover:border-2 hover:border-purple hover:text-purple transition ease-in-out duration-300" to="/cookieGuidelines">Mehr Informationen</router-link>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props:['cookie'],
    watch:{
        
    },

    methods:{
        setCookie(accepted){
            this.cookie = accepted;
            window.scrollTo(0,0);
            
            if(window.sessionStorage.getItem("acceptCookies") != null){
                window.sessionStorage.setItem("acceptCookies", accepted);
            }else{
                window.sessionStorage.setItem("acceptCookies", false);
            }
        }
    }
    
}
</script>

<style>

</style>