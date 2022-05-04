
"use strict";

/*
    html elemente
*/
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
    window.sessionStorage.setItem(cookiekey, true);
    refCookieSettings.classList.remove("hidden");
    console.log("Cooke-Acceptance Status updated to: " + true);
    location.reload();
});
noButton.addEventListener('click', () => {
    dialog.classList.add("hidden");
    window.sessionStorage.setItem(cookiekey, false);
    refCookieSettings.classList.remove("hidden");
    console.log("Cooke-Acceptance Status updated to: " + false);
    location.reload();
});



//Wait 5 Seconds for Cookie-Check
var delayInMilliseconds = 5000; //5 seconds

setTimeout(function() {
  //Code to be delayed
  //Disable Dialog if property already set
  if (window.sessionStorage.getItem(cookiekey) != null) {
    /*
        User has already accepted or declined cookies
    */
    dialog.classList.add("hidden");
    //Aktivieren des A-Tags um auf Seite für Cookie-Settings zu kommen
    refCookieSettings.classList.remove("hidden");
    console.log("Cookie-Acceptance Status: " + window.sessionStorage.getItem(cookiekey));


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
}, delayInMilliseconds);

    


