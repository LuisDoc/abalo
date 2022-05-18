<template>
    <div id="searchbar" class="z-10 absolute top-0 w-full bg-white" :class="{hidden: !search}">
        <div class="grid grid-cols-3">
            <div class="m-5"><span class=" hover:cursor-pointer" id="back" @click="search=false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-2 ml-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="rmund" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </span>
            </div>
            <div class="m-5">
                <form action="" method="" @submit.prevent="paginationSearch">
                    <div class="relative border-b-2 border-gray-600 hover:border-gray-800">
                        <input type="text" name="search" placeholder="z.B Delorean" class="w-full pl-8 p-2 text-purple" v-model="searchvalue" @keyup="paginationSearch" @keydown="paginationSearch">
                        <span class="absolute left-0 mr-6 mt-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <button class="absolute right-0 mr-6 mb-2  p-1  mt-1 hover:bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <div class="m-5">
            </div>
        </div>
        <div class="grid-cols-2  ml-64 mr-64 mt-12 mb-12 gap-4" v-if="showResults">
            <template v-if="size > 0">
                <span v-for="(link,index) in links.slice(0,-1)" :key="link.label" class="mt-10">
                    <span v-if="index>0 && link.url!=null && link.label!='Next &raquo;'" @click="nextPage(link.label)" :id="link.label" 
                    :class="[link.active==true? 'bg-red-600 p-2 rounded-md  mr-1 text-white hover:bg-white hover:text-purple hover:cursor-pointer':'bg-purple p-2 rounded-md  mr-1 text-white hover:bg-white hover:text-purple hover:cursor-pointer' ]" class="bg-purple p-2 rounded-md  mr-1 text-white hover:bg-white hover:text-purple hover:cursor-pointer" v-text="index"></span>
                </span>
                <div  v-for="article in articlesearch" :key="article.id" class=" bg-purple rounded-lg mt-4">
                    <a  :href="`#S${article.id}`" @click="handleReroute">
                        <div class="p-4">
                            <h1 class="headline font-bold mb-2 truncate text-white">{{ article.ab_name }}</h1>
                            <p class="text-sm mt-4 text-gray-200 font-semibold mb-1"><b class="text-white">Preis:</b> {{ article.ab_price }}</p>
                            <p class="text-sm text-gray-200 mb-1 truncate"><b class="text-white">About:</b>
                                {{ article.ab_description }}</p>
                            <p class="text-sm text-gray-200 mb-1"><b class="text-white">Creator:</b>
                                {{ article.ab_creator_id }}</p>
                            <p class="text-sm text-gray-200 mb-1"><b class="text-white">Created at:</b>
                                {{ article.ab_createdate }}</p>
                        </div>
                    </a>
                </div>
            </template>
            <template v-else class="col-span-2">
                <content-loader 
                    viewBox="0 0 476 124"
                    primaryColor="#977DE2"
                    secondaryColor="#cccccc"
                    class=""
                    >
                    <rect x="0" y="24" rx="3" ry="3" width="150" height="6" />
                    <rect x="0" y="40" rx="3" ry="3" width="52" height="6" />
                    <rect x="0" y="56" rx="3" ry="3" width="320" height="6" />
                    <rect x="0" y="72" rx="3" ry="3" width="350" height="6" />
                    <rect x="0" y="88" rx="3" ry="3" width="178" height="6" />
                </content-loader>
            </template>
            
        </div>
    </div>
</template>

<script>
import { ContentLoader } from 'vue-content-loader'
export default {
    name: "Searchbar",
    props:["search"],
    components:{
        ContentLoader
    },
    data(){
        return{
            searchvalue:"",
            articlesearch: [],
            size:0,
            showResults: false,
            links:[]
        }
    },
    methods:{
        //Old Search
        async handleSearch(){
            if(this.searchvalue.length >2){
                await fetch(`http://localhost:8000/api/articles?search=${this.searchvalue}`)
                .then((res)=>res.json())
                .then(data=>{
                    this.articlesearch = data.articles;
                    this.size = data.articles.length;
                })
                .catch((err)=>console.log(err))

                this.showResults = true;
            }else{
                this.articlesearch= []
                this.size = 0;
            }
            
        },
        //Paginated Search
        async paginationSearch(){
            if(this.searchvalue.length >=1){
                await fetch(`http://localhost:8000/api/articles?search=${this.searchvalue}&page=0`)
                .then(res=>{
                    let json = res.json();
                    return json;
                }).then(data =>{
                    this.links = data.articles.links;
                    this.articlesearch = data.articles.data;
                    this.size = data.articles.data.length;
                })
                .catch(err=>console.log(err))
                this.showResults = true;
            }else{
                this.articlesearch= []
                this.size = 0;
            }
        },
        nextPage(page){
             fetch(`http://localhost:8000/api/articles?search=${this.searchvalue}&page=${page}`)
            .then(res=>{
                let json = res.json();
                return json;
            }).then(data =>{
                this.articlesearch = data.articles.data;
                this.size = data.articles.data.length;
            })
            .catch(err=>console.log(err))

            this.links.forEach((e)=>{
                if(e.label != page){
                    e.active= false;
                }
                else{
                    e.active = true;
                }
            })
        },

        handleReroute(){
            this.showResults=false;
            if(this.$route.name != "/articles"){
                this.$router.push('/articles');
            }
        }
    }
}
</script>

<style>

</style>