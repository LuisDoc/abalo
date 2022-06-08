<template>
<div>
  <div class="bg-cgray">
        <div class="text-6xl headline ml-64 pt-20 mb-20 text-purple">
            Alle Artikel im Überblick
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
        
        <!-- Anzeige aller Inserate -->
        <div class="mt-20" v-else>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 p-32 px-64 pt-1 gap-4">
                <!-- Artikel Anzeige-->
                <div v-for="article in ab_articles" :key="article.id" class="class= bg-white hover:shadow-lg hover:outline hover:outline-purple transition ease-in-out">
                    <router-link :to="'/article/' + article.id" :id="'S'+article.id">
                        <div class="p-4">
                            <h1 class="headline font-bold mb-2 truncate text-purple">{{ article.ab_name }}</h1>
                            <p class="text-sm mt-4 text-gray-600 font-semibold mb-1"><b class="text-purple">Preis:</b> {{ article.ab_price.toFixed(2) /100 }}</p>
                            <p class="text-sm text-gray-600 mb-1 truncate"><b class="text-purple">About:</b>
                                {{ article.ab_description }}</p>
                            <p class="text-sm text-gray-600 mb-1"><b class="text-purple">Creator:</b>
                                {{ article.owner.id }}</p>
                            <p class="text-sm text-gray-600 mb-1"><b class="text-purple">Created at:</b>
                                {{ article.ab_createdate }}</p>

                            <img :id="article.id" :src="'/images/articlepictures/' + article.id + '.jpg'" alt=""
                                    class="w-full h-60 object-cover mt-5" @error="replaceImage(article.id)">
                        </div>
                         <template  v-if="user.token!=null">
                            <div class ="p-4 flex justify-end">
                                <template v-if="user.data.id==article.ab_creator_id">
                                        <a  :id="'buy'+ article.id" class ="w-14 h-15 rounded-full p-2 bg-white border-red-400 hover:bg-red-400 border-2 hover:border-red-400 transition duration-300 ease-out" href="/removeArticle/{{$article->id}}">
                                            <img src="/images/TrashCan.png" alt="">
                                        </a>
                                </template>
                                <template v-else>
                                    <button :id="'buy'+ article.id" @click.prevent="addToShoppingCart(article.id)" :class="[shoppingcartItems && shoppingcartItems.includes(article.id)?'w-14 h-15 rounded-full p-2 border-2 border-red-400 hover:bg-red-400 transition duration-300 ease-out':'w-14 h-15 rounded-full p-2 border-2 border-green-400 hover:bg-green-400 transition duration-300 ease-out']">
                                        <img src="/images/warenkorb.png" alt="">
                                    </button> 
                                </template>
                            </div>
                        </template> 
                    </router-link>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { ContentLoader } from 'vue-content-loader'
import Navbar from "../components/Navbar.vue"
import {mapState} from 'vuex'
import { useToast } from "vue-toastification";
import gql from 'graphql-tag'
export default {
    setup(){
        const toast = useToast();
        return {toast}
    },
    components:{
        ContentLoader, Navbar
    },
    apollo: {
        ab_articles: gql`{
            ab_articles{
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
        }`
    },
    data(){
        return{
            //articles: [],
            shoppingcartItems: [],
            count: 0
        }
        
    },
    computed:{
        ...mapState(['user'])
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
            let red = "w-14 h-15 rounded-full p-2 border-2 border-red-400 hover:bg-red-400 transition duration-300 ease-out";
            let green = "w-14 h-15 rounded-full p-2 border-2 border-green-400 hover:bg-green-400 transition duration-300 ease-out"

            const btn = document.querySelector(`#buy${id}`);
            let decision = btn.classList == green ? red : green;
            btn.setAttribute("class",decision);

            let xhr = new XMLHttpRequest();
            let url = "http://localhost:8000/api/shoppingcart/" + this.user.data.id
            let params = "articleID="+id;
            xhr.open("post",url);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
            
            }
            xhr.onerror = function(){
                console.warn("Fehler beim laden des Artikelcounters");
            }
            xhr.send(params);
        },
        updateArticles(id){
            this.articles = this.articles.filter(article => article.id != id);
        }
    },
    async mounted(){
        window.scrollTo(0, 0);
        /*await fetch("http://localhost:8000/api/articles")
        .then(res => {
            let json = res.json();
            return json;
        }).then(data => this.articles = data)
        .catch(err=>console.log(err));
        
        let loader =document.getElementById("loader");
        loader.classList.add("hidden");*/


        await fetch("http://localhost:8000/api/shoppingcart/"+ this.user.data.id)
        .then(res=>{
            let json = res.json();
            return json;
        }).then(data=>{
            if(Array.isArray(data)){
                this.shoppingcartItems = data;
            }
        })

        const user = this.user;
        const toast = this.toast;
        const updateArticles = this.updateArticles;
        let count = this.count;
        Echo.channel('Sale')
        .listen('Sold', function(e){
            //Update Articles
            updateArticles(e.article);
            //Notify Article Creator only
            if(user && user.data.id == e.userid && count == 0){
                toast.success(e.message);
                count++;
            }
        });
    }
}
</script>

<style>

</style>