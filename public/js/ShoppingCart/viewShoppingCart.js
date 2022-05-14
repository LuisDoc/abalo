"use strict";

//Search HTML Elements
const anker = document.querySelector("#carttable");


//Abfrage der Daten
function getObjects() {
    let getObjectsRequest = new XMLHttpRequest();
    let getObjects_url = "/api/shoppingcart/" + auth_user_id;

    getObjectsRequest.open("get",getObjects_url);

    getObjectsRequest.onload = function(){
        let collection = JSON.parse(getObjectsRequest.responseText);
        if(collection['error']){
            print(collection,false);
        }
        else{
            collection.forEach( (entry) => {
                print(entry, true);
            });
        }
        
        
    }
    getObjectsRequest.onerror = function(){
        console.warn("Objekte konnten nicht geladen werden");
    }
    getObjectsRequest.send();
}

getObjects();


//Drucken der Übertragenen Elemente
function print(entry, mode){
    const warningMessage = document.querySelector("#warning");
    if(mode == true){
        warningMessage.classList.add("hidden");

        let article = entry['article'][0];

        const row = document.createElement('tr');
        row.setAttribute('id', article['id'])
        const picturecolumn = document.createElement('td');
        const namecolumn = document.createElement('td');
        const pricecolumn = document.createElement('td');
        const removecolumn = document.createElement('td');
        //Tailwind CSS
        row.setAttribute("class","TableRow");
        picturecolumn.setAttribute("class","TableColumn");
        namecolumn.setAttribute("class","TableColumn");
        pricecolumn.setAttribute("class","TableColumn");
        removecolumn.setAttribute("class","TableColumn flex justify-center pt-20");
        
        //Bilder
        const imgPic = document.createElement('img');
        //Bilder Tailwind CSS
        //imgPic.setAttribute("class","img");
        //Pfade setzen
       
        imgPic.setAttribute("src","/images/articlepictures/"+ article['id'] + ".jpg");
        imgPic.setAttribute("onerror", `this.onerror = null; this.src="/images/articlepictures/${article['id']}.png"`)
        imgPic.setAttribute("alt","Bild einfügen");
        imgPic.setAttribute("class", "w-60 h-60 object-cover mt-5");
        

        //Bilder anhängen
        picturecolumn.appendChild(imgPic);

        //Name und Preis
        pricecolumn.innerHTML = article['ab_price'] / 100 + "€";
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
    else{
        warningMessage.classList.remove("hidden"); 
    }
    
}

function removeShoppingCart(article){
    
    let id = article['id'];

    //Request zum entfernen
    let xhr = new XMLHttpRequest();
    let url = "/api/shoppingcart/" + auth_user_id + "/articles/" + id;

    xhr.open("delete",url);

    xhr.onload = function(){
      
    }
    xhr.onerror = function(){
        
    }
    xhr.send();


    var articleToDelete = document.getElementById(id);
    articleToDelete.parentNode.removeChild(articleToDelete)
    
    //Bell Aktualisieren
    bellUpdate();
}
