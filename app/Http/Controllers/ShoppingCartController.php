<?php

namespace App\Http\Controllers;

use App\Models\ab_article;
use App\Models\ab_articlecategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\ab_shoppingcart;
use App\Models\ab_shoppingcart_item;
use App\Models\User;
class ShoppingCartController extends Controller
{
    public function getShoppingCart(){        
        return view('tailwind.shoppingCart')->with('articles',ab_article::all());
    }

    /*
    *   API Routen
    */

    //Artikel 
    public function getShoppingCart_api($creator_id){

        $user = User::find($creator_id);
       
        $cart = $user->myShoppingCart;
    
        $collection = $cart->myarticles;

        $articles = collect();
        foreach($collection as $item){
            $articles->add($item->article);
        }
        return response()->json($articles,400);
    }
    //Abfragen der Aktuellen Warenkorb größe
    public function getShoppingCartSize_api($creator_id){
        $user = User::find($creator_id);
        if(!$user){
            return response()->json(["error: " => "user was not found"]);
        }
        else if(!$user->myShoppingCart){
            return response()->json(["error: " => "user hat not yet initialised his shopping cart"]);
        }
        else{
            $count = $user->myShoppingCart->myarticles->count();
            return response()->json(["size: " => $count]);
        }
        
    }
    //Wird nur aufgerufen, wenn getShoppingCartSize bisher leer war, also ein neuer Korb
    //initialisiert werden muss
    public function putShoppingCart_api($creator_id){
        //Hat der Nutzer bereits einen Warenkorb angelegt?
        $found = ab_shoppingcart::where('ab_creator_id','=',$creator_id)->get();
        if($found->count()){
            return response()->json(["error: " => "user has already initialized his shopping cart"]);
        }
        //Warenkorb anlegen
        $cart = new ab_shoppingcart();
        $cart->ab_creator_id = $creator_id;
        $cart->save();
        return response()->json(["sucess: " => "shopping cart was initialized", "ID" => $cart->id]);
    }
    //Aktualisieren des Warenkorb Inhaltes
    public function postShoppingCart_api($creator_id, Request $request){
        /*
            Validierung
        */
        $user = User::find($creator_id);
        if(!$user){
            return response()->json(["error: " => "user not found"]);
        }
        $articleID = (intval($request->articleID));
        if(ab_article::find($articleID) == null){
            return response()->json(["error: " => "article not found"]);
        }
        $cart = $user->myShoppingCart;
        if($cart == null){
            return response()->json(["error: " => "shopping cart not initialized"]);
        }
        $cartID = $cart->id;
        /*
        *   Realisierung des hinzufügen und entnehmen von Artikel über ein Togglen
        *   Somit benötigt ein Funktionsaufruf bei entfernen oder hinzufügen
        */
        $found = ab_shoppingcart_item::where('ab_shoppingcart_id','=',$cartID)
        ->where('ab_article_id','=',$articleID)->get();


        //Wenn ein Artikel gefunden wurde,muss der aktuelle gelöscht werden
        if($found->count()){
            foreach($found as $toDelete){
                ab_shoppingcart_item::destroy($toDelete->id);
                return response()->json(["success: " => "article was removed from shopping cart"]);
            }
        }else{
            //Wenn kein Artikel gefunden wurde, kann der neue hinzugefügt werden
            $entry = new ab_shoppingcart_item();
            $entry->ab_shoppingcart_id = $cartID;
            $entry->ab_article_id = $articleID;
            $entry->save();
            return response()->json(["success: " => "article was added to shopping cart"]);
        }        
        
        
        

        
    }

}
