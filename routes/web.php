<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

/*
    Home-Routen
*/
Route::redirect('/','/articles');
Route::redirect('/home','/articles')->middleware('auth');

//Route::get('/', [HomeController::class,'getHome']);
//Route::get('/home', [HomeController::class,'getHome']);


/*
    Artikel-Routen
*/
Route::get('/articles',[ArticleController::class,'showAllArticle']);
Route::get('/articles/search',[ArticleController::class,'showArticle']);


/*
Authentication routes
*/
//Weiterleitung zu Views
Route::get('/showLogin', function()
{
    return view('auth.login');
})->name('login');;
Route::get('/showRegister', function()
{
    return view('auth.register');
});
//Anmeldung
Route::POST('/login',[AuthController::class,'login']);
Route::POST('/register',[AuthController::class,'register']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');




