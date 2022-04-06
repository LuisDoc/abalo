
"use strict";

let key = "acceptCookies";
const dialog = document.querySelector("#CookieDialog");

if (window.sessionStorage.getItem(key) != null) {
    /*
        User has already accepted or declined cookies
    */
    dialog.classList.add("hidden");
    console.log("Cookie-Acceptance Status: " + window.sessionStorage.getItem(key));

}
else {
    /*
        User has not been asked for Cookie-Settings
    */
    console.log("Cookie Status: " + window.sessionStorage.getItem(key));
    dialog.classList.remove("hidden");
}
