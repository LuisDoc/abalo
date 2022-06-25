<template>
    <div class="bg-cgray">
        <div v-if="!$apollo.loading" class="text-6xl headline ml-64 pt-20 mb-20 text-purple">
            <router-link to="/articles">⬅️</router-link>
            {{ ab_article.ab_name}}
        </div>
        <div id=loader v-if="$apollo.loading">
            <content-loader 
                viewBox="0 0 476 124"
                primaryColor="#7497e8"
                secondaryColor="#cccccc"
                class="ml-64"
                >
                <rect x="48" y="8" rx="3" ry="3" width="88" height="6" />
                <rect x="48" y="26" rx="3" ry="3" width="52" height="6" />
                <rect x="0" y="56" rx="3" ry="3" width="320" height="6" />
                <rect x="0" y="72" rx="3" ry="3" width="350" height="6" />
                <rect x="0" y="88" rx="3" ry="3" width="178" height="6" />
                <circle cx="20" cy="20" r="20" />
            </content-loader>
        </div>
        <div class="mt-20 p-32 px-64 pt-1 gap-4" v-else>
            <main class="my-8">
                <div class="container mx-auto px-16">
                    <div class="md:flex md:items-center">
                        <div class="w-full h-64 md:w-1/2 lg:h-96">
                            <img :id="ab_article.id" @error="replaceImage(ab_article.id)" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="'/images/articlepictures/' + ab_article.id + '.jpg'" alt="Article">
                        </div>
                        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                            <h3 class="text-gray-700 uppercase text-lg">{{ab_article.ab_name}}</h3>
                            <span v-if="!discount" class="text-gray-500 mt-3">{{ab_article.ab_price}}€</span>
                            <span v-else class="text-red-500 mt-3">{{(ab_article.ab_price) - (ab_article.ab_price * Math.floor(Math.random()*100)/100).toFixed(2)}}€</span>
                            <hr class="my-3">
                            <div class="mt-2">
                                <h3 class="text-gray-700 uppercase text-lg">Description</h3>
                                <span class="text-gray-500 mt-3">{{ab_article.ab_description}}</span>
                            </div>
                            <div class="flex items-center mt-6">
                                <button class=" text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none" @click.prevent="addToShoppingCart(ab_article.id)">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
        
</div>
</template>

<script>
import { useToast } from "vue-toastification";
import { ContentLoader } from 'vue-content-loader'
import {mapState} from 'vuex'
import gql from 'graphql-tag'

export default {
    props: ['discount'],
    setup(){
        const toast = useToast();
        return {toast}
    },
    components:{
        ContentLoader
    },
    apollo: {
        ab_article: {
            query: gql`query($id:ID!){
                    ab_article(id:$id){
                        id
                        ab_name
                        ab_description
                        ab_price
                        ab_createdate
                        owner{
                            id
                            ab_name
                        }
                    }
            }`,
            variables(){
                return {
                    id: this.$route.params.id
                }
            },
        }
    },
    computed:{
        ...mapState(['user']),
        currentUserId(){
            return this.$route.params.id;
        }
    },
    data(){
         return{
            article: {},
            //discount: false,
            count: -1,
        }
    },
    methods:{
        replaceImage(id){
            let test = new Image();
            test.onload=function(){
                document.getElementById(id).src = "/images/articlepictures/" +id+ ".png";
            }
            test.onerror=function(){
                document.getElementById(id).src ="/images/placeholder.jpg";
            }
            test.src ="/images/articlepictures/" +id+ ".png";
        },
        addToShoppingCart(id){
            let xhr = new XMLHttpRequest();
            let url = "http://localhost:8000/api/shoppingcart/" + this.user.data.id
            let params = "articleID="+id;
            xhr.open("post",url);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
            const toast = this.toast;
            xhr.onload = function(){
                toast.success("Article added to shopping cart");
            }
            xhr.onerror = function(){
                console.warn("Fehler beim laden des Artikelcounters");
            }
            xhr.send(params);
        },
    },
    start() {
        this.discount = !this.discount;
        // Konfiguration
        this.$confetti.start(
            {
                //Partikelformen
                particles : [
                    { type: 'heart',},
                    { type: 'circle'},
                ],
                //Partikelfarben
                defaultColors: [
                    'Gold',
                    '#7497e8',
                ],
            }  
        );
        //Stoppe Konfetti-Effekt nach 3500 Millisekunden
        setTimeout(() => {
            this.$confetti.stop();
        }, 3500);
        
    },
    mounted(){
        window.scrollTo(0, 0);
        console.log("mounted");
        /*
        fetch("http://localhost:8000/api/article/"+ this.currentUserId)
        .then(res => {
            let json = res.json();
            return json;
        }).then(data => this.article = data)
        .then(()=>{
            let loader =document.getElementById("loader");
            loader.classList.add("hidden");

        })
        .catch(err=>console.log(err));
        */
        const toast =  this.toast;
        const router = this.$router;
        const start = this.start;
        //Websocket Verbindung zum Server
        //Abhören des Promotion Channel
        Echo.channel('Promotion')
        .listen('Promotion', function(e){
            let article = JSON.parse(e.article)
            //Wenn der User den Artikel betrachtet, wird der Konfetti-Effekt gestartet
            if(router.currentRoute._value.path == "/article/"+article.id){
                toast.error(e.message);
                //Konfetti-Effekt
                start();
            }
        });
    }
}
</script>

<style>

</style>
