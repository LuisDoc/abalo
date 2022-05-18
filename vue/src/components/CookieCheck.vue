<template>
<!--Cookiedialog-->
    <div  v-if="!cookie" ref="CookieDialog" class=" fixed bottom-0 w-screen bg-purple text-white z-50 h-32">
        <div class="flex ">
            <div class ="w-2/3 mt-4 mb-4 mx-10" >
            <h1 class="text-align-left text-4xl">Cookie-Einstellungen</h1>
            <p class ="text-base">
                Mit einem Klick auf "Zustimmen" akzeptieren Sie die Nutzung von Cookies,
                um Ihnen moderne Funktionalitäten und Services bieten zu können.
                <a class ="text-lg italic underline" href="/CookieGuidelines">Mehr Informationen</a>
            </p>
            </div>
            <div class ="w-1/3  mt-12 inline-block">
                <span  @click.prevent="acceptCookies" class="CookieButton p-4 hover:cursor-pointer">Akzeptieren</span>
                <span  @click.prevent="denyCookies" class="CookieButton p-4 hover:cursor-pointer">Ablehnen</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"CookieCheck",
    data(){
        return{
            cookie: false
        }
    },
    methods:{
        acceptCookies(){
            this.$refs.CookieDialog.classList.add("hidden");
            window.sessionStorage.setItem("acceptCookies", true);
            let setting = true;
            this.cookie= true;
            this.$emit("cookieevent",setting)
            
        },
        denyCookies(){
            this.$refs.CookieDialog.classList.remove("hidden");
            window.sessionStorage.setItem("acceptCookies", false);
            let setting = false;
            this.cookie = true;
            this.$emit("cookieevent", setting)
            
        }
    },
}
</script>

<style>

</style>