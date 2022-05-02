
"use strict";

const bell = document.querySelector("#shoppingcartbell");

function bellUpdate (){
    let xhrShoppingCartBell = new XMLHttpRequest();
    let urlGetSize = "/api/shoppingcart/" + auth_user_id + "/size";
    
    xhrShoppingCartBell.open("get",urlGetSize);

    xhrShoppingCartBell.onload = function(){
        let amount = JSON.parse(xhrShoppingCartBell.responseText)['size'];
        if(amount > 0 && amount != undefined && amount != null){
            bell.innerHTML = amount;
            bell.classList.remove("hidden");
        }
        else{
            bell.classList.add("hidden");
        }
    }

    xhrShoppingCartBell.send();
}
bellUpdate();


//let amount = sessionStorage.getItem("ShoppingCart");
