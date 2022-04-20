"use strict";

//Search HTML Elements
const anker = document.querySelector("#carttable");

let sessionData = JSON.parse(sessionStorage.getItem(shoppingcartkey));


articles.forEach((article)=>{
    let articleID = article['id'];
    //Iterieren durch Warenkorb
    sessionData.forEach((shoppingcartid)=>{
       if(articleID == shoppingcartid){
            //Funktionsaufruf zum Printen
            print(article);

       }
    });
});

function print(article){
    const row = document.createElement('tr');
    row.setAttribute('id', article.id)
    const picturecolumn = document.createElement('td');
    const namecolumn = document.createElement('td');
    const pricecolumn = document.createElement('td');
    const removecolumn = document.createElement('td');
    //Tailwind CSS
    row.setAttribute("class","TableRow");
    picturecolumn.setAttribute("class","TableColumn");
    namecolumn.setAttribute("class","TableColumn");
    pricecolumn.setAttribute("class","TableColumn");
    removecolumn.setAttribute("class","TableColumn flex justify-center");
    
    //Bilder
    const imgPic = document.createElement('img');
    //Bilder Tailwind CSS
    //imgPic.setAttribute("class","img");
    //Pfade setzen
    
    imgPic.setAttribute("src","/images/articlepictures/"+article.id + ".jpg");
    imgPic.setAttribute("onerror", `this.onerror = null; this.src="/images/articlepictures/${article.id}.png"`)
    imgPic.setAttribute("alt","Bild einfügen");
    imgPic.setAttribute("class", "w-60 h-60 object-cover mt-5");
    

    //Bilder anhängen
    picturecolumn.appendChild(imgPic);

    //Name und Preis
    pricecolumn.innerHTML = article['ab_price'] / 100;
    namecolumn.innerHTML = article['ab_name'];

    //Entfernen Button
    const button = document.createElement('button');
    button.setAttribute("class","text-base btn p-2 border border-purple");
    button.innerHTML = "Entfernen";
    //Eventhandler bauen
    button.addEventListener('click',(button) =>{
        button.preventDefault();
        removeShoppingCart(article);
    });
    //Button zusammensetzen
    removecolumn.appendChild(button);
    //Zeile zusammensetzen
    row.appendChild(picturecolumn);
    row.appendChild(namecolumn);
    row.appendChild(pricecolumn);
    row.appendChild(removecolumn);
    anker.appendChild(row);
}

function removeShoppingCart(article){
    let cart = JSON.parse(sessionStorage.getItem(shoppingcartkey));
    let id = article['id'];
    //Anlegen eines neuen Warenkorbs
    let newCart = [];
    //Iteration in O(n) - entfernen der ID aus der Session
    cart.forEach((number)=>{
        if(number != id){
            newCart.push(number);
        }
    });
    sessionStorage.setItem(shoppingcartkey,JSON.stringify(newCart)); 
    var articleToDelete = document.getElementById(article.id);
    articleToDelete.parentNode.removeChild(articleToDelete)
    let amount = JSON.parse(sessionStorage.getItem(shoppingcartkey)).length;
    if(amount > 0 && amount != undefined && amount != null){
        bell.innerHTML = amount;
        bell.classList.remove("hidden");
    }
    else{
        bell.classList.add("hidden");
    }
}
