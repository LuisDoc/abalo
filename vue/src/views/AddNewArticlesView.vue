<template>
  <div>
    <div class="bg-cgray pt-5">
      <h1 class="firstHeadline m-64">Artikel verkaufen</h1>
       <div id="addArticleForm" class=""><!-- Inhalt via JS-->
            <form class ="mt-20" @submit.prevent="handleSubmit">
              <div class="min-h-screen md:px-20 pt-6">
                <div class=" bg-white border-2 border-purple rounded-lg px-6 py-10 mx-64 mx-auto">
                  <!-- Fehlermeldungen -->
                  <h2 ref="warningMessage" v-if= "submitted" class="text-green-600"></h2>
                  <h2 ref="warningMessage" v-else class="text-red-600"></h2>

                  <div class="space-y-4">
                    <div>
                      <label for="title" class="text-lx mr-5">Artikelname:</label>
                      <input refs ="inputName" type="text" @keyup="validateArticleName(name)" v-model="name" placeholder="Name" id="title" class="bg-cgray my-4 outline-none py-1 px-2 text-md border-2 rounded-md inp" />
                      <label for="price" class="text-lx mx-5">Price:</label>
                      <input refs ="inputPrice" type="number" @keyup="validateArticlePrice(price)" min="0.01" step="0.01" v-model="price"  placeholder="Preis" id="title" class="bg-cgray my-4 outline-none py-1 px-2 text-md border-2 rounded-md inp" />
                    </div>
                    <div>
                      <label for="description" class="block mb-2 text-lg">Artikelbeschreibung:</label>
                      <textarea id="description" v-model="desc" cols="30" rows="10" placeholder="Beschreiben Sie Ihren Artikel..." class="bg-cgray my-4 p-5 outline-none w-full text-md border-2 rounded-md inp"></textarea>
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
import {mapState} from 'vuex'
import axiosClient from "../axios"
export default {
   computed:{
        ...mapState(['user'])
    }, 
  data(){
    return{
      name:"",
      price:0,
      desc:"",
      nameCorrect: false,
      priceCorrect: false,
      submitted: false,
      articles:[]
    }
  },
  methods:{
    handleSubmit(){
      if(this.nameCorrect & this.priceCorrect){
        //Request Server to add Article
        let uri = "/articles";
        axiosClient.post("/articles", {
          name: this.name,
          price: this.price,
          description: this.description,
          creator_id: this.user.data.id
        })
        .then(function(response){
          //Erfolgreicher Request
          console.log("Artikel wurde erfolgreich hinzugefügt");
        })
        .catch(function(error){
          //Fehlerbehandlung
          console.log("Es ist ein Fehler, beim hinzufügen des Artikels, aufgetreten");
        });


        //Change flag to true --> Trigger Visible Changes to UI
        this.submitted = true;
        console.log(this.submitted);
      }
      this.UpdateWarningMessage();
    },
    validateArticleName(name){
      //Does Article with same name already exist?
      if(this.articles.find((article)=>article.ab_name.toLowerCase()== name.toLowerCase())){
        this.nameCorrect = false;
      }
      else{
        this.nameCorrect = true;
      }
      this.UpdateWarningMessage();
    },
    validateArticlePrice(price){
      //Not allowed characters?
      if(!String(price).match(/^\d*\.?\d{1,2}$/) ||  parseFloat(this.price)<= 0 ){
        this.priceCorrect = false; 
      }
      else{
          this.priceCorrect = true;
      }
      this.UpdateWarningMessage();
    },
    UpdateWarningMessage(){
      this.$refs['warningMessage'].innerHTML = "";
      //Artikel wurde hinzugefügt
      if(this.submitted){
        this.$refs['warningMessage'].innerHTML = "Artikel erfolgreich hinzugefügt";
        //Reset submitted value, Artikel wurde hinzugefügt
        this.submitted = false;
      }
      else{
        if(!this.nameCorrect)
          this.$refs['warningMessage'].innerHTML = "Fehlerhafte Eingabe für Name.";
        //Wenn Preis falsch eingegeben wurde
        if(!this.priceCorrect)
          this.$refs['warningMessage'].innerHTML += " Fehlerhafte Eingabe für Preis";
      }
    }
  },
  mounted(){
    axiosClient.get("/articles")
    .then(res => this.articles = res.data)
  }
}
</script>

<style>

</style>