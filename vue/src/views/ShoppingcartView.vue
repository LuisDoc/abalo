<template>
  <div class ="p-20">
        <h1 class ="firstHeadline">Warenkorb</h1>
        <!-- Anzeige aller Artikel innerhalb einer Tabelle -->
        <table id="anker" class ="w-full outline outline-purple rounded-xl">
            <thead class ="bg-gray-200 border-b-2 border-purple">
                <td class ="secondHeadline p-5"></td>
                <td class ="secondHeadline p-5">Name</td>
                <td class ="secondHeadline p-5">Preis</td>
                <td class ="secondHeadline p-5"></td>
            </thead>
            <tbody id="carttable">
                <tr id="2" class="TableRow" v-for="article in shoppingcartItems" :key="article.id">
                    <td class="TableColumn">
                        <img :id="article.id" :src="'/images/articlepictures/' + article.id + '.jpg'" alt="" class="w-60 h-60 object-cover mt-5" @error="replaceImage(article.id)">
                    </td>
                    <td class="TableColumn">{{article.article.ab_name}}</td>
                    <td class="TableColumn">{{article.article.ab_price}}</td>
                    <td class="TableColumn flex justify-center pt-20">
                    <button :id="'buy'+ article.id" class="text-base btn p-2 border border-purple" @click.prevent="addToShoppingCart(article.ab_article_id)">Entfernen</button></td>
                </tr>
            </tbody>   
        </table>
        <div class ="flex justify-end my-20 mr-10">
            <div>
                <button class ="btn p-2 text-2xl ho ver:border hover:border-purple">Bestellen</button>
            </div>
        </div>
        
    </div>
</template>

<script>
import {mapState} from 'vuex'
export default {
    data(){
        return{
            shoppingcartItems : []
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
        async addToShoppingCart(id){
            console.log(id)
            await fetch(`http://localhost:8000/api/shoppingcart/${this.user.data.id}/articles/${id}`, {method:"DELETE"})
            .then(res=>res.json())
            .catch(err=>console.log(err))

            this.shoppingcartItems = this.shoppingcartItems.filter((items)=>{
                return items.ab_article_id != id;
            })
        }     
    },
    async mounted(){
        await fetch("http://localhost:8000/api/shoppingcart/"+ this.user.data.id)
        .then(res=>{
            let json = res.json();
            return json;
        }).then(data=>{
            
            this.shoppingcartItems = data;
        }).catch((err)=>{
            console.log(err);
        })
    }
}
</script>

<style>

</style>