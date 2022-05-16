<template>
<!--Cookiedialog-->
    <div ref="CookieDialog" class=" fixed bottom-0 w-screen bg-purple text-white z-50 h-32">
        <div class ="w-2/3 mt-4 mb-4 mx-10" >
            <h1 class="text-align-left text-4xl">Cookie-Einstellungen</h1>
            <p class ="text-base">
                Mit einem Klick auf "Zustimmen" akzeptieren Sie die Nutzung von Cookies,
                um Ihnen moderne Funktionalitäten und Services bieten zu können.
                <a class ="text-lg italic underline" href="/CookieGuidelines">Mehr Informationen</a>
            </p>
        </div>
        <div class ="w-1/3 mt-4 mb-4 mx-10 flex justify-center">
            <span  @click.prevent="acceptCookies" class="CookieButton">Akzeptieren</span>
            <span  @click.prevent="denyCookies" class="CookieButton">Ablehnen</span>
        </div>
        
    </div>
</template>

<script>
export default {
    name:"CookieCheck",
    data(){
        return{

        }
    },
    methods:{
        acceptCookies(){
            this.$ref.CookieDialog.classList.add("hidden");
            window.sessionStorage.setItem(cookiekey, true);
            this.$emit("AcceptCookie",cookie=true);
            location.reload();
        },
        denyCookies(){
            this.$ref.CookieDialog.classList.remove("hidden");
            window.sessionStorage.setItem(cookiekey, false);
            this.$emit("AcceptCookie",cookie=false);
            location.reload();
        }
    }
}
</script>

<style>

</style>