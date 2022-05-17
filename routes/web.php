<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

//Einstiegsseite
Route::view('/newsite',"tailwind.landingpage");
Route::redirect('/','/newsite');
//Home-Routen
Route::get('/index', [HomeController::class,'getHome']);
Route::redirect('/home','/index');
//Artikel-Routen
Route::controller(ArticleController::class)->group(function(){
    Route::match(['get', 'post'], '/articles','showAllArticle');
    Route::get('/removeArticle/{id}','deleteArticle')->middleware('auth');
    Route::get('/myarticle','showMyArticle')->middleware('auth');
    Route::get('/newarticle','showNewArticleForm')->middleware('auth');
});
//Services and Accessories
Route::view('/faq', 'tailwind.services_and_accessories.faq');
//Route::view('/impressum', 'tailwind.services_and_accessories.impressum');
//Cookies
Route::view('/CookieGuidelines', 'tailwind.Cookie.CookieGuidelines');
Route::view('/CookieSettings', 'tailwind.Cookie.CookieSettings');
//View Routing
Route::view('/showLogin', 'tailwind.auth.login')->name('login');
Route::view('/showRegister', 'tailwind.auth.register');
//Einkaufswagen
Route::get('/ShoppingCart',[ShoppingCartController::class,'getShoppingCart']);
//Anmeldung
Route::controller(AuthController::class)->group(function(){
    Route::post('/login','login');
    Route::post('/register','register');
    Route::get('/logout', 'logout')->middleware('auth');
});



