
"use strict";

let key = "acceptCookies";
const dialog = document.querySelector("#CookieDialog");
const yesButton = document.querySelector("#CookieDialogYes");
const noButton = document.querySelector("#CookieDialogNo");

/*
    Event Handler:
    Yes and No Button
*/
yesButton.addEventListener('click', () => {
    dialog.classList.add("hidden");
    window.sessionStorage.setItem(key, true);
    console.log("Cooke-Acceptance Status updated to: " + true);
});
noButton.addEventListener('click', () => {
    dialog.classList.add("hidden");
    window.sessionStorage.setItem(key, false);
    console.log("Cooke-Acceptance Status updated to: " + false);
});


//Disable Dialog if property already set
if (window.sessionStorage.getItem(key) != null) {
    /*
        User has already accepted or declined cookies
    */
    dialog.classList.add("hidden");
    console.log("Cookie-Acceptance Status: " + window.sessionStorage.getItem(key));

}
//Enable Dialog if property is not set
else {
    /*
        User has not been asked for Cookie-Settings yet
    */
        dialog.classList.remove("hidden");
        console.log("Cookie-Acceptance Status: " + "Not set yet");
}
