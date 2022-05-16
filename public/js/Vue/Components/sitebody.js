/*
    Body Komponente
*/
export default{
    //Variablen und Daten
    data(){
        return{
            key :"",
            all_articles:[],
            articles:[],
        }
    },
    //Methoden
    methods:{
        handleSearch(){
            if(this.key.length >= 1){
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
            }
            console.log(this.articles);
        }
    },
    //Abfrage aller Artikel für Suchfunktion
    mounted(){
        fetch("http://localhost:8000/api/articles")
        .then(res=>{
            let json= res.json();
            return json;
        })
        .then(data=>{
            this.all_articles = data;
        });
    },
    template: "#body"
}