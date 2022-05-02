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
Route::match(['get', 'post'], '/articles', [ArticleController::class, "articles_api"]);
Route::delete("/articles/{id}", [ArticleController::class, "delete_api"]);
//Shopping Cart
Route::get('/shoppingcart/{creator_id}/size',[ShoppingCartController::class,"getShoppingCartSize_api"]);
Route::get('/shoppingcart/{creator_id}',[ShoppingCartController::class,"getShoppingCart_api"]);
//Initialisieren des Warenkorbs
Route::post('/shoppingcart/{creator_id}',[ShoppingCartController::class,"postShoppingCart_api"]);
//Aktualisieren des Warenkorbs
Route::put('/shoppingcart/{creator_id}',[ShoppingCartController::class,"putShoppingCart_api"]);
//Löschen des Warenkorbs
Route::delete('/shoppingcart/{creator_id}',[ShoppingCartController::class,"deleteShoppingCart_api"]);