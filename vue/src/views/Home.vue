<template>
   <div>
        <!--Main Content-->
        <div class="relative">
            <div style="background-image: url('../../public/images/shop.jpg'); height:857px"></div>
            <div class="shade"></div>
            <div class="absolute top-28 left-56">
                <div class="text-purple text-5xl headline w-64">
                    ABALO - Der beste Gebrauchtwarenhändler
                </div>
                <div class="text-purple text-2xl mt-4 headline">
                    Entdecke die große Auswahl an Produkten hier bei Abalo
                </div>
                <router-link class="mt-6 py-4 px-8 pr-2 btn block w-36" to="/articles">
                    Entdecken
                </router-link>
            </div>
        </div>
        <!--Latest 3 articles-->
        <div class="bg-cgray">
            <div class="text-5xl headline ml-64 pt-20 mb-20 text-purple">
                Neuste Artikel
            </div>
            <!-- Anzeigen der drei zuletzt hinzugefügten Artikel -->
            <div class="mt-20">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 p-32 px-64 pt-1 gap-4">
                <!-- Artikel Anzeige-->
                <div v-for="article in newestArticles" :key="article.id" class="class= bg-white hover:shadow-lg hover:outline hover:outline-purple transition ease-in-out">
                    <a  href="" :id="article.ab_name + article.id">
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
                    </a>
                </div>
            </div>
        </div>
            

            <div class="flex justify-center align-center">
                <router-link class="mt-6 mb-6 py-4 px-8 pr-2 btn block w-36" to="/articles">
                    Alle Artikel
                </router-link>
            </div>


        </div>
   </div> 
</template>

<script>

export default {
    name: "Home",
    data(){
        return{
            newestArticles:[]
        }
    },
    methods:{
        
    },
    mounted(){
        fetch("http://localhost:8000/api/articles")
        .then(res=>res.json())
        .then(data => this.newestArticles = data.slice(0,3))
        .catch(err=>console.log(err));

    }
}
</script>

<style>

</style>