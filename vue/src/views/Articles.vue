<template>
<div>
  <div class="bg-cgray">
        <div class="text-6xl headline ml-64 pt-20 mb-20 text-purple">
            Alle Artikel im Überblick
        </div>
        <div id=loader>
            <content-loader 
                viewBox="0 0 476 124"
                primaryColor="#977DE2"
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
        
        <div class="mt-20">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 p-32 px-64 pt-1 gap-4">
                <!-- Artikel Anzeige-->
                <div v-for="article in articles" :key="article.id" class="class= bg-white hover:shadow-lg hover:outline hover:outline-purple transition ease-in-out">
                    <a  href="" :id="article.id + article.id">
                        <div class="p-4">
                            <h1 class="headline font-bold mb-2 truncate text-purple">{{ article.ab_name }}</h1>
                            <p class="text-sm mt-4 text-gray-600 font-semibold mb-1"><b class="text-purple">Preis:</b> {{ article.ab_price }}</p>
                            <p class="text-sm text-gray-600 mb-1 truncate"><b class="text-purple">About:</b>
                                {{ article.ab_description }}</p>
                            <p class="text-sm text-gray-600 mb-1"><b class="text-purple">Creator:</b>
                                {{ article.ab_creator_id }}</p>
                            <p class="text-sm text-gray-600 mb-1"><b class="text-purple">Created at:</b>
                                {{ article.ab_createdate }}</p>

                            <img :id="article.id" :src="'/images/articlepictures/' + article.id + '.jpg'" alt=""
                                    class="w-full h-60 object-cover mt-5" @error="replaceImage(article.id)">
                        </div>
                         <template  v-if="user.token!=null">
                            <div class ="p-4 flex justify-end">
                                <template v-if="user.data.id==article.ab_creator_id">
                                        <a class ="w-14 h-15 rounded-full p-2 bg-white border-red-400 hover:bg-red-400 border-2 hover:border-red-400 transition duration-300 ease-out" href="/removeArticle/{{$article->id}}">
                                            <img src="/images/TrashCan.png" alt="">
                                        </a>
                                </template>
                                <template v-else>
                                    <button id="addShoppingCart{{$article->id}}" class ="w-14 h-15 rounded-full p-2 border-2 border-green-400 hover:bg-green-400 transition duration-300 ease-out">
                                        <img src="/images/warenkorb.png" alt="">
                                    </button> 
                                </template>
                            </div>
                        </template> 
                    </a>
                    
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
export default {
    components:{
        ContentLoader, Navbar
    },
    data(){
        return{
            articles: [],
        }
        
    },
    computed:{
        ...mapState(['user'])
    },
    methods:{
        replaceImage(id){
            
            document.getElementById(id).src ="/images/placeholder.jpg";
            
        }
    },
    async mounted(){
        window.scrollTo(0, 0);
        await fetch("http://localhost:8000/api/articles")
        .then(res => {
            let json = res.json();
            return json;
        }).then(data => this.articles = data)
        .catch(err=>console.log(err));
        
        let loader =document.getElementById("loader");
        loader.classList.add("hidden");

    }
}
</script>

<style>

</style>