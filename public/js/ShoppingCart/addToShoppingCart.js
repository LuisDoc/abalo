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
            btn.addEventListener('click',(e) =>{
                e.preventDefault();
                handle(element, id);
            });
        }
    }
}

function handle(e,id){
    e.preventDefault;
    //Ist Warenkorb bereits initialisiert?
    let xhr = new XMLHttpRequest();
    let url = "/api/shoppingcart/" + auth_user_id;
    let params = "articleID="+id;
    xhr.open("put",url);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
       console.log(xhr.responseText);
    }
    xhr.onerror = function(){
        console.warn("Fehler beim laden des Artikelcounters");
    }
    xhr.send(params);
    
    /*Realtime Counter update*/
    bellUpdate();
}
