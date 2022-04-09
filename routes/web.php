<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

/*
    Main-Routes
*/
//Home-Routen
Route::get('/', [HomeController::class,'getHome']);
Route::redirect('/home','/');
//Artikel-Routen
Route::match(['get', 'post'], '/articles',[ArticleController::class,'showAllArticle']);
Route::get('/removeArticle/{id}',[ArticleController::class,'deleteArticle'])->middleware('auth');
Route::get('/myarticle',[ArticleController::class,'showMyArticle'])->middleware('auth');
Route::get('/newarticle',[ArticleController::class,'showNewArticleForm'])->middleware('auth');
//Einkaufswagen
Route::get('/ShoppingCart',[ShoppingCartController::class,'getShoppingCart']);
//Services and Accessories
Route::get('/faq', function(){return view('tailwind.services_and_accessories.faq');});
Route::get('/impressum', function(){return view('tailwind.services_and_accessories.impressum');});
//Cokies
Route::get('/CookieGuidelines', function(){ return view ('tailwind.Cookie.CookieGuidelines');});
Route::get('/CookieSettings', function(){return view('tailwind.Cookie.CookieSettings');});
/*
    Auth
*/
//Weiterleitung zu Views
Route::get('/showLogin', function(){ return view('tailwind.auth.login'); })->name('login');
Route::get('/showRegister', function(){ return view('tailwind.auth.register');});
//Anmeldung
Route::POST('/login',[AuthController::class,'login']);
Route::POST('/register',[AuthController::class,'register']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');




