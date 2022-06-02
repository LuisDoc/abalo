<template>
  <div>
    <div class="bg-cgray pt-5">
      <h1 class="firstHeadline m-64">Artikel verkaufen</h1>
       <div id="addArticleForm" class=""><!-- Inhalt via JS-->
            <form class ="mt-20" @submit.prevent="handleSubmit">
              <div class="min-h-screen md:px-20 pt-6">
                <!-- SCSS Style Anfang -->
                <div class="form__container">
                  <!-- Fehlermeldungen -->
                  <h2 ref="warningMessage" class="text-red-600"></h2>

                  <div class="space-y-4">
                    <div>
                      <label for="title" class="form__label">Artikelname:</label>
                      <input refs ="inputName" type="text" @keyup="validateArticleName(name)" v-model="name" placeholder="Name" id="title" class="form__input form__input__row" />
                      <label for="price" class="form__label">Price:</label>
                      <input refs ="inputPrice" type="number" @keyup="validateArticlePrice(price)" min="0.01" step="0.01" v-model="price"  placeholder="Preis" id="title" class="form__input form__input__row" />
                    </div>
                    <div>
                      <label for="description" class="form__label">Artikelbeschreibung:</label>
                      <textarea id="description" v-model="desc" cols="30" rows="10" placeholder="Beschreiben Sie Ihren Artikel..." class="form__input form__input__block"></textarea>
                    </div>
                    <div>
                      <input class="form__button" type="submit" value="Artikel Hochladen">
                    </div>
                  </div>
                </div>
                 <!-- SCSS Style Ende -->
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
      if(this.articles.find((article)=>article.ab_name.toLowerCase()== name.toLowerCase()) || name.length == 0){
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
      this.$refs['warningMessage'].setAttribute("class", "text-red-600");
      //Artikel wurde hinzugefügt
      if(this.submitted){
        this.$refs['warningMessage'].setAttribute("class", "text-green-600");
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

<style lang="scss">
  $cgray: #F2F2F2;
  $blue: #7497e8;
  .form{
    &__container{
      padding: 3rem;
      margin-left: 16rem;
      margin-right:16rem;
      background-color:white;
      border-width: 3px;
      border-radius: 0.75rem;
      border-color:$blue ;
    }
    
    &__label{
       font-size:1rem;
       line-height:1.5rem;
       margin-top: 1reme;
       margin-right: 1rem;
    }

    &__input{
      background-color:mix(white, $cgray, 60);
      padding-top: 1rem;
      padding-bottom: 1rem;
      padding-left: 2rem;
      padding-right: 2rem;
      margin-right: 3rem;
      border-width: 2px;
      border-radius: 0.75rem;
      border-color:$cgray;
      &:focus{
        border-color:$blue;
      }
      &:hover{
        border-color:$blue;
      }
      &__block{
        width:100%;
      }
      &__row{
        width:30%;
      }
    }


    &__button{
      padding: 1rem;
      margin-top: 1rem;
      border-color: $cgray;
      border-width: 3px;
      border-radius: 0.75rem;
      color:white;
      background-color: $blue;

      //on Hover
      &:hover{
        border-color:$blue;
        background-color: mix(white, $blue, 40);
      }
    }
  }


</style>