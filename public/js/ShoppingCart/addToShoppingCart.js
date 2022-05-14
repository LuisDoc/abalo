"use strict";

if(articles){
    for(let objNumber in articles){
        let element = articles[objNumber];
        let id = element['id'];
        //Element mit gleicher ID in HTML suchen
        const btn = document.querySelector("#addShoppingCart"+id);
        
        if(btn){
            btn.addEventListener('click',(e) =>{
                e.preventDefault();
                handle(element, id, btn);
            });
        }
    }
}

function handle(e,id, btn){
    //Toggle Colors
    let red = "w-14 h-15 rounded-full p-2 border-2 border-red-400 hover:bg-red-400 transition duration-300 ease-out";
    let green = "w-14 h-15 rounded-full p-2 border-2 border-green-400 hover:bg-green-400 transition duration-300 ease-out"
    
    let decision = btn.classList == green ? red : green;
    btn.setAttribute("class",decision);

    

    e.preventDefault;
    //Ist Warenkorb bereits initialisiert?
    let xhr = new XMLHttpRequest();
    let url = "/api/shoppingcart/" + auth_user_id;
    let params = "articleID="+id;
    xhr.open("post",url);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
       
    }
    xhr.onerror = function(){
        console.warn("Fehler beim laden des Artikelcounters");
    }
    xhr.send(params);
    
    /*Realtime Counter update*/
    bellUpdate();
}
