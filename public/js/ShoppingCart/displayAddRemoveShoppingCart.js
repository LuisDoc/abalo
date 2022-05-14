//Daten über Artikel im Shopping Cart besorgen
let xhr = new XMLHttpRequest();
let params = "";
let url = "/api/shoppingcart/" + auth_user_id;

xhr.open("GET", url);

xhr.onload = function(){
    displayButtonCorrectly(JSON.parse(xhr.response));
}
xhr.onerror = function(){
    
}
xhr.send();


function displayButtonCorrectly (items){
    
    let red = "w-14 h-15 rounded-full p-2 border-2 border-red-400 hover:bg-red-400 transition duration-300 ease-out";

    if(items instanceof Array){
        items.forEach((item)=>{
            console.log("Artikel mit der ID " + item['ab_article_id'] + " befindet sich bereits im Warenkorb");
            let articleID = item['ab_article_id'];
            let btn = document.querySelector("#addShoppingCart"+articleID);
            if(btn != null){
                btn.setAttribute("class",red);
            }
        });
    }
   
}