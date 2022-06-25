<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Events\Maintenance;
use App\Http\Middleware\RedisLog;
use Illuminate\Support\Facades\Redis;
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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
        
    });
    Route::post('/logout', [AuthController::class, "api_logout"]);
});
    

//All Request will be logged
Route::middleware([RedisLog::class])->group(function(){
    //Artikel
    Route::controller(ArticleController::class)->group(function(){
        Route::match(['get', 'post'], '/articles', 'articles_api');
        Route::delete("/articles/{id}", 'delete_api');
        Route::get("/article/{id}", 'article_api');
        Route::post('/createArticle', "addArticle");
        Route::post("/promote/{id}", "promoteArticle_api");
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
        Route::delete('/shoppingcart/{creator_id}',[ShoppingCartController::class,"buyShoppingCart_api"]);
        //Delete article from Shopping Cart
        Route::delete('/shoppingcart/{creator_id}/articles/{article_id}',[ShoppingCartController::class,"deleteArticleFromShoppingCart"]);
    });

    Route::get("/maintenance", function(){
        broadcast(new Maintenance("In Kürze verbessern wir Abalo für Sie!\nNach einer kurzen Pause sind wir wieder für sie da! Versprochen"));
    });

});

Route::controller(AuthController::class)->group(function(){
    Route::post('/register', 'api_register');
    Route::post('/login', 'api_login');
    
});

Route::get('/loadstatistics', function(){
    $log = Redis::hgetall('log');
    return response()->json($log, 200);
});


