<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'getHome']);
Route::get('/home', [HomeController::class,'getHome']);

//Artikelansicht
Route::get('/articles',[ArticleController::class,'showAllArticle']);
Route::get('/articles/search',[ArticleController::class,'showArticle']);

