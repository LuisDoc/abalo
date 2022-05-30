<template>
  <div>
    <div class="bg-cgray pt-5">
      <h1 class="firstHeadline m-64">Artikel verkaufen</h1>
        <!-- Fehlermeldungen -->
       <div id="addArticleForm" class=""><!-- Inhalt via JS-->
            <form class ="mt-20" @submit.prevent="handleSubmit">
              <div class="min-h-screen md:px-20 pt-6">
                <div class=" bg-white rounded-md px-6 py-10 mx-64 rounded rounded-full mx-auto">
                  <h1 class="text-center text-2xl text-gray-500 mb-10">Artikel hinzufügen</h1>
                  <h2 ref="warningMessage" class="text-red-600"></h2>
                  <div class="space-y-4">
                    <div>
                      <label for="title" class="text-lx">Artikelname:</label>
                      <input type="text" @keyup="validateArticleName(name)" v-model="name" placeholder="Name" id="title" class="my-4 outline-none py-1 px-2 text-md border-2 rounded-md inp" />
                      <label for="price" class="text-lx">Price:</label>
                      <input type="number" @keyup="validateArticlePrice(price)" min="0.01" step="0.01" v-model="price"  placeholder="Preis" id="title" class="my-4 outline-none py-1 px-2 text-md border-2 rounded-md inp" />
                    </div>
                    <div>
                      <label for="description" class="block mb-2 text-lg">Artikelbeschreibung:</label>
                      <textarea id="description" v-model="desc" cols="30" rows="10" placeholder="whrite here.." class="w-full font-serif  p-4 text-gray-600 bg-indigo-50 outline-none rounded-md"></textarea>
                    </div>
                    <div>
                      <input class="btn p-2 mx-5 rounded-xl border border-purple" type="submit" value="Artikel Hochladen">
                    </div>
                    
                  </div>
                </div>
              </div>
            </form>
      </div>
    </div>
  </div>
</template>

<script>
import axiosClient from "../axios"
export default {
  data(){
    return{
      name:"",
      price:0,
      desc:"",
      nameCorrect: false,
      priceCorrect: false,
      articles:[]
    }
  },
  methods:{
    handleSubmit(){
      if(nameCorrect & priceCorrect){

      }
      else{
          //Form nicht vollständig
          const warningField = this.$refs['warningMessage'].innerHTML = "Bitte alle Felder korrekt ausfüllen";
      }
    },
    validateArticleName(name){
      //Reset Warning Message
      this.$refs.warningMessage.innerHTML = "";
      let article = this.articles.find((article)=>article.ab_name== name)
      if(article){
        //Set inner html
        this.$refs.warningMessage.innerHTML = "Artikel mit gleichem Namen befindet sich bereits in der Datenbank";
        this.nameCorrect = false;
      }
      else{
        this.nameCorrect = true;
      }
    },
    validateArticlePrice(price){
      console.log("Price handler called", price);
      //Reset Warning message
      this.$refs.warningMessage.innerHTML = "";
      //Check for not allowed values
      console.log(price);
      if(!price.match(/^\d*\.?\d{1,2}$/) ||  parseFloat(this.price)<= 0 ){
        this.priceCorrect = false;
        const warningField = this.$refs['warningMessage'].innerHTML = "Ungültige Preiseingabe";
      }
      else{
          this.priceCorrect = true;
      }
    },
  },
  mounted(){
    axiosClient.get("/articles")
    .then(res => this.articles = res.data)
  }
}
</script>

<style>

</style>