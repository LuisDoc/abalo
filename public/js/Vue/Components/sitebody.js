/*
    Body Komponente
*/
export default{
    props: ['contentSwitch'],
    emits: ['contentSwitch'],

    //Variablen und Daten
    data(){
        return{
            key :"",
            all_articles:[],
            articles:[],
            links: []
            
        }
    },
    //Methoden
    methods:{
        //
        handleSwitchToLandingPage(){
            console.log("Handler called in Body - Switch to LandingPage");
            this.$emit('contentSwitch','landingPage');
        },
        //Alter Search unpaginated
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
        },
        //Neue Search paginated
        paginationSearch(){
            fetch(`http://localhost:8000/api/articles?search=${this.key}&page=0`)
            .then(res=>{
                let json = res.json();
                return json;
            }).then(data =>{
                this.links = data.articles.links;
                this.articles = data.articles.data;
            })
            .catch(err=>console.log(err))
        },
        nextPage(page){
             fetch(`http://localhost:8000/api/articles?search=${this.key}&page=${page}`)
            .then(res=>{
                let json = res.json();
                return json;
            }).then(data =>{
                this.articles = data.articles.data;
                console.log(this.links)
            })
            .catch(err=>console.log(err))

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