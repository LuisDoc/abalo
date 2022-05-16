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
                this.initItems=true;
                //Ankerpunkt abfragen
                const anker = this.$refs.menu_item_list;
                this.initNavbarItemsRecursive(anker, this.menu_items);
            }
        },
        initNavbarItemsRecursive(listanker, items){
            //Neue Liste erstellen
            const ul = document.createElement('ul');
            items.forEach( (element) =>{
                //Element hinzufügen
                const li = document.createElement('li');
                const a = document.createElement('a');
                
                //A-Tag Werte setzen
                a.innerHTML = element['name'];
                a.setAttribute("href",element['href']);
                
                //Eintrag hinzufügen
                li.appendChild(a);
                ul.appendChild(li);

                //Auf Unterkategorien achten
                if(element['sub']){
                    this.initNavbarItemsRecursive(li, element['sub']);
                }
            });
            listanker.appendChild(ul);
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
                { name: 'Unternehmen', sub: [{ name: 'Philosophie', href: "" }, { name: 'Karriere', href: "" }] },
            ],
        }
    },
    template:"#navbar"
}