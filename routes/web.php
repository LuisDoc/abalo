<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;

/*
    Home-Routen
*/
Route::redirect('/','/articles');
Route::redirect('/home','/articles');

//Route::get('/', [HomeController::class,'getHome']);
//Route::get('/home', [HomeController::class,'getHome']);


/*
    Artikel-Routen
*/
Route::get('/articles',[ArticleController::class,'showAllArticle']);
Route::get('/articles/search',[ArticleController::class,'showArticle']);

