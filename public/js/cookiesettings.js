"use strict";
const accept = document.querySelector("#btnAcceptCookies");
const refuse = document.querySelector("#btnRefuseCookies");

let statusKey = "acceptCookies";

//Select CSS Class depending on current Cookie Settings
if (window.sessionStorage.getItem(statusKey) != null) {
    /*
        User has already accepted or declined cookies
    */
    accept.classList.remove("hidden");
    refuse.classList.remove("hidden");
    
   if(window.sessionStorage.getItem(statusKey) === "true"){
    accept.setAttribute("class","CookieSettingsButtonChecked");
    refuse.setAttribute("class","CookieSettingsButtonUnChecked");
   }
   else{
    accept.setAttribute("class","CookieSettingsButtonUnChecked");
    refuse.setAttribute("class","CookieSettingsButtonChecked");
   }
}
else{
    //Noch keine Auswahl getroffen
    accept.setAttribute("class","CookieSettingsButtonUnChecked");
    refuse.setAttribute("class","CookieSettingsButtonUnChecked");
}

//Event Handling

accept.addEventListener('click',() =>{
    window.sessionStorage.setItem(statusKey,true);
    console.log("Cookies changed are now accepted")
    location.reload();
});
refuse.addEventListener('click',() =>{
    window.sessionStorage.setItem(statusKey,false);
    console.log("Cookies changed are now declined")
    location.reload();
});