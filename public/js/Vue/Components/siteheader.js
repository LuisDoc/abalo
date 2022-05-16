/*
    Header Komponente
*/
export default{
    methods:{
        toggleNavbar(){
            if(!this.initItems)
                this.initNavbarItems();
            if(this.showNavbar)
                this.$refs.menu.classList.add("hidden");
            else{
                this.$refs.menu.classList.remove("hidden");
                
            }
            this.showNavbar =!this.showNavbar;
        },
        initNavbarItems(){
            //Wenn die Elemente noch nicht angehangen wurden
            if(!this.initItems){
                console.warn("Menu-Items werden initialisiert");
                  //Ankerpunkt abfragen
                  const anker = this.$refs.menu_item_list;
                  

            }
        },
        initNavbarItemsRecursive(){

        }
    },
    data(){
        return{
            showNavbar:false,
            initItems: false,
            menu_items : [
                { name: 'Home', href: "/home" },
                { name: 'Artikel', href: "/articles" },
                { name: 'Kategorien', href: "/categories" },
                { name: 'Verkaufen', href: "/newarticle" },
                { name: 'Unternehmen', sub: [{ name: 'Philosophie', href: "" }, { name: 'Karriere', href: "" }] }
            ],
        }
    },
    template:"#navbar"
}