
"use strict";

/*
    Zeige Dialog für Cookie-Optionen
*/

let key = "acceptCookies";
const dialog = document.querySelector("#CookieDialog");
const yesButton = document.querySelector("#CookieDialogYes");
const noButton = document.querySelector("#CookieDialogNo");
const refCookieSettings = document.querySelector("#refCookieSettings");

/*
    Event Handler:
    Yes and No Button
*/
yesButton.addEventListener('click', () => {
    dialog.classList.add("hidden");
    window.sessionStorage.setItem(key, true);
    refCookieSettings.classList.remove("hidden");
    console.log("Cooke-Acceptance Status updated to: " + true);
    location.reload();
});
noButton.addEventListener('click', () => {
    dialog.classList.add("hidden");
    window.sessionStorage.setItem(key, false);
    refCookieSettings.classList.remove("hidden");
    console.log("Cooke-Acceptance Status updated to: " + false);
    location.reload();
});



//Disable Dialog if property already set
    if (window.sessionStorage.getItem(key) != null) {
        /*
            User has already accepted or declined cookies
        */
        dialog.classList.add("hidden");
        //Aktivieren des A-Tags um auf Seite für Cookie-Settings zu kommen
        refCookieSettings.classList.remove("hidden");
        console.log("Cookie-Acceptance Status: " + window.sessionStorage.getItem(key));

    
    }
    //Enable Dialog if property is not set
    else {
        /*
            User has not been asked for Cookie-Settings yet
        */
            dialog.classList.remove("hidden");
            //Deaktivieren des A-Tags um auf Seite für Cookie-Settings zu kommen
            refCookieSettings.classList.add("hidden");
            console.log("Cookie-Acceptance Status: " + "null/undefined");
            
    }


