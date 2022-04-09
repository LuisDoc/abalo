"use strict";

//Search HTML Elements
const anker = document.querySelector("#anker");

let sessionData = sessionStorage.getItem(shoppingcartkey);

articles.forEach((e)=>{
    let articleID = e['id'];
    //Iterieren durch Warenkorb
    sessionData.forEach((e) =>{
        
    })
    if(sessionData.includes(articleID)){
        console.log(articleID + "liegt im Warenkorb");
    }
});
