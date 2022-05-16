"use strict";

const app = Vue.createApp({
    data(){
        return{
            key :"",
            all_articles:[],
            articles:[],
            showHeadline: false,
        }
    },
    methods:{
        handleChange(){
            
            if(this.key.length >= 3){
                this.showHeadline = true;
                this.articles = this.all_articles;
                let searchvalue = this.key.toLowerCase();
                //Artikel suchen und anzeigen
                this.articles = this.articles.filter((article)=>{
                    let name = article.ab_name.toLowerCase();
                    return name.indexOf(searchvalue)!= -1;
                })
                this.articles = this.articles.slice(0,5);
            }
            else{
                this.articles = [];
                this.showHeadline = false;
            }
            
        }
    },
    mounted(){
        fetch("http://localhost:8000/api/articles")
        .then(res=>{
            let json= res.json();
            return json;
        })
        .then(data=>{
            this.all_articles = data;
        });
    }
}).mount("#app");