
"use strict";

const bell = document.querySelector("#shoppingcartbell");

//let amount = sessionStorage.getItem("ShoppingCart");
let amount = JSON.parse(sessionStorage.getItem(shoppingcartkey)).length;

if(amount > 0 && amount != undefined && amount != null){
    bell.innerHTML = amount;
    bell.classList.remove("hidden");
}
else{
    bell.classList.add("hidden");
}