<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Artikel
Route::controller(ArticleController::class)->group(function(){
    Route::match(['get', 'post'], '/articles', 'articles_api');
    Route::delete("/articles/{id}", 'delete_api');
    Route::post('/createArticle', "addArticle");
});


//Shopping Cart
Route::controller(ShoppingCartController::class)->group(function(){
    //Shopping Cart Size
    Route::get('/shoppingcart/{creator_id}/size',"getShoppingCartSize_api");
    //Shopping Cart Elements in JSON
    Route::get('/shoppingcart/{creator_id}',"getShoppingCart_api");
    //Shopping Cart Update
    Route::post('/shoppingcart/{creator_id}',[ShoppingCartController::class,"postShoppingCart_api"]);
    //Delete whole Shopping Cart
    Route::delete('/shoppingcart/{creator_id}',[ShoppingCartController::class,"deleteShoppingCart_api"]);
    //Delete article from Shopping Cart
    Route::delete('/shoppingcart/{creator_id}/articles/{article_id}',[ShoppingCartController::class,"deleteArticleFromShoppingCart"]);
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/register', 'api_register');
    Route::post('/login', 'api_login');
});