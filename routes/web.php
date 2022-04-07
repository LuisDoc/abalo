<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

/*
    Main-Routes
*/
//Home-Routen
Route::get('/', [HomeController::class,'getHome']);
Route::redirect('/home','/');
//Artikel-Routen
Route::get('/articles',[ArticleController::class,'showAllArticle']);
Route::get('/myarticle',[ArticleController::class,'showMyArticle'])->middleware('auth');
Route::get('/newarticle',[ArticleController::class,'showNewArticleForm'])->middleware('auth');
//Services and Accessories
Route::get('/faq', function(){return view('tailwind.services_and_accessories.faq');});
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




