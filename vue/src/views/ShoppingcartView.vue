<template>
  <div class ="p-20">
        <h1 class ="firstHeadline">Warenkorb</h1>
        <!-- Anzeige aller Artikel innerhalb einer Tabelle -->
        <table  id="anker" class ="w-full outline outline-purple rounded-xl">
            <thead class ="bg-gray-200 border-b-2 border-purple">
                <td class ="secondHeadline p-5"></td>
                <td class ="secondHeadline p-5">Name</td>
                <td class ="secondHeadline p-5">Preis</td>
                <td class ="secondHeadline p-5"></td>
            </thead>    
            <tbody v-if="shoppingcartItems.length" id="carttable">
                <tr id="2" class="TableRow" v-for="article in shoppingcartItems" :key="article.id">
                    <td class="TableColumn">
                        <img :id="article.ab_article_id" :src="'/images/articlepictures/' + article.ab_article_id + '.jpg'" alt="" class="w-60 h-60 object-cover mt-5" @error="replaceImage(article.id)">
                    </td>
                    <td class="TableColumn">{{article.article[0].ab_name}}</td>
                    <td class="TableColumn">{{article.article[0].ab_price}}</td>
                    <td class="TableColumn flex justify-center pt-20">
                    <button :id="'buy'+ article.ab_article_id" class="text-base btn p-2 border border-purple" @click.prevent="addToShoppingCart(article.ab_article_id)">Entfernen</button></td>
                </tr>
            </tbody>   
        </table>
        <div class ="flex justify-center">
             <p v-if="!shoppingcartItems.length" class="lex justify-center my-20 mr-10 text-red-600 text-2xl">{{shoppingcartmessage}}</p>
        </div>
        <div class ="flex justify-end my-20 mr-10">
            <button v-if ="shoppingcartItems.length" @click.prevent ="buyShoppingCart(shoppingcartItems[0].ab_shoppingcart_id)" class ="btn p-2 text-2xl ho ver:border hover:border-purple">Bestellen</button>
        </div>
        
    </div>
</template>

<script>
import {mapState} from 'vuex'
export default {
    data(){
        return{
            shoppingcartItems : [],
            shoppingcartmessage: "Noch keine Elemente im Warenkorb",
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
            console.log("Add Article to Shopping Cart with ID: "+ id);
            await fetch(`http://localhost:8000/api/shoppingcart/${this.user.data.id}/articles/${id}`, {method:"DELETE"})
            .then(res=>res.json())
            .catch(err=>console.log(err))

            this.shoppingcartItems = this.shoppingcartItems.filter((items)=>{
                return items.ab_article_id != id;
            })
        },
        async buyShoppingCart(id){
            //Payment & Shipping
            // Nicht in diese Praktikum implementiert

            //Delete Shopping Cart
            console.log("Check out for ShoppingCart with ID:  " + id);
            await fetch(`http://localhost:8000/api/shoppingcart/${this.user.data.id}`, {method:"DELETE"})
            .then(res=>res.json())
            .then(() =>{
                //Delete All Items from Database
                console.log(this.shoppingcartItems);
            })
            .then( () => this.shoppingcartItems = [])
            .then( () =>this.shoppingcartmessage = "Einkauf erfolgreich" )
            .catch(err=>console.log(err))
            //Delete Items from Shop

            //Implement Article Creator Notification Praktikum 5
        },     
    },
    async mounted(){
        await fetch("http://localhost:8000/api/shoppingcart/"+ this.user.data.id)
        .then(res=>{
            let json = res.json();
            return json;
        }).then(data=>{
            this.shoppingcartItems = data;
        }).catch((err)=>{
            this.shoppingcartItems = [];
            console.log(err);
        })
    }
}
</script>

<style>

</style>