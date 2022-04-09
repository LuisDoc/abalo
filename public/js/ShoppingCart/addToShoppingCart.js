"use strict";


console.warn("Aktueller Warenkorb");
console.log(sessionStorage.getItem(shoppingcartkey));


if(articles){
    for(let objNumber in articles){
        let element = articles[objNumber];
        let id = element['id'];
        //Element mit gleicher ID in HTML suchen
        const btn = document.querySelector("#addShoppingCart"+id);
        
        if(btn){
            btn.addEventListener('click',() =>{
                handle(element, id);
            });
        }
    }
}

function handle(e,id){
    let articles = [];
    articles = JSON.parse(sessionStorage.getItem(shoppingcartkey));
    console.warn("Aktueller Warenkorb");
    console.log(articles);

    if(articles == null){
        articles = [id];
        sessionStorage.setItem(shoppingcartkey,JSON.stringify(articles));
    }
    else if(!articles.includes(id)){
        articles.push(id);
        sessionStorage.setItem(shoppingcartkey,JSON.stringify(articles));
    }
    else{
        console.log("Already in Shopping Cart");
    }
    


    
}