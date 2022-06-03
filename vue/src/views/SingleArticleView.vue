<template>
    <div class="bg-cgray">
        <div class="text-6xl headline ml-64 pt-20 mb-20 text-purple">
            <router-link to="/articles">⬅️</router-link>
            {{ article.ab_name}}
        </div>
        <div id=loader>
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
        <div class="mt-20 p-32 px-64 pt-1 gap-4">
            <main class="my-8">
                <div class="container mx-auto px-16">
                    <div class="md:flex md:items-center">
                        <div class="w-full h-64 md:w-1/2 lg:h-96">
                            <img :id="article.id" @error="replaceImage(article.id)" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="'/images/articlepictures/' + article.id + '.jpg'" alt="Article">
                        </div>
                        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                            <h3 class="text-gray-700 uppercase text-lg">{{article.ab_name}}</h3>
                            <span class="text-gray-500 mt-3">{{article.ab_price / 100}}€</span>
                            <hr class="my-3">
                            <div class="mt-2">
                                <h3 class="text-gray-700 uppercase text-lg">Description</h3>
                                <span class="text-gray-500 mt-3">{{article.ab_description}}</span>
                            </div>
                            <div class="flex items-center mt-6">
                                <button class=" text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none" @click.prevent="addToShoppingCart(article.id)">
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


export default {
    setup(){
        const toast = useToast();
        return {toast}
    },
    components:{
        ContentLoader
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
    mounted(){
        window.scrollTo(0, 0);
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
    }
}
</script>

<style>

</style>