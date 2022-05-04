console.log("ShoppingCart Button Script Started");
//Daten über Artikel im Shopping Cart besorgen
let xhr = new XMLHttpRequest();
let params = "";
let url = "/api/shoppingcart/" + auth_user_id;

xhr.open("GET", url);

xhr.onload = function(){
    console.warn("HttpRequest was successfull - Articles in Shopping Card loaded successfully");
    displayButtonCorrectly(JSON.parse(xhr.response));
}
xhr.onerror = function(){
    console.warn("HttpRequest wasn't successfull");
}
xhr.send();


function displayButtonCorrectly (items){
    
    let red = "w-14 h-15 rounded-full p-2 border-2 border-red-400 hover:bg-red-400 transition duration-300 ease-out";

    console.warn("Artikel die sich bereits im Warenkorb befinden:");
    items.forEach((item)=>{
        console.log("Artikel mit der ID " + item['ab_article_id'] + " befindet sich bereits im Warenkorb");
        let articleID = item['ab_article_id'];
        let btn = document.querySelector("#addShoppingCart"+articleID);
        if(btn != null){
            btn.setAttribute("class",red);
        }
    });
}