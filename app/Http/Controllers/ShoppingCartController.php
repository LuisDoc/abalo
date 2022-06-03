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
use App\Events\Sold;
use App\Events\Maintenance;
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
        if(!$user){
            return response()->json(["error" => "user was not found"]);
        }
        if(!$user->myShoppingCart){
            return response()->json(["error" => "user hat not yet initialised his shopping cart"]);
        }
        $cart = $user->myShoppingCart;

        $collection = $cart->myarticles;

        $articles = collect();
        foreach($collection as $item){
            $articles->add($item->article);
        }
        return response()->json($collection,200);
    }
    //Abfragen der Aktuellen Warenkorb größe
    public function getShoppingCartSize_api($creator_id){
        $user = User::find($creator_id);
        if(!$user){
            return response()->json(["error" => "user was not found"]);
        }
        else if(!$user->myShoppingCart){
            return response()->json(["error" => "user hat not yet initialised his shopping cart"]);
        }
        else{
            $count = $user->myShoppingCart->myarticles->count();
            return response()->json(["size" => $count]);
        }
        
    }
    
    //Aktualisieren des Warenkorb Inhaltes
    public function postShoppingCart_api($creator_id, Request $request){
        /*
            Validierung
        */
        $user = User::find($creator_id);
        if(!$user){
            return response()->json(["error" => "user not found"]);
        }
        $articleID = (intval($request->articleID));
        if(ab_article::find($articleID) == null){
            return response()->json(["error" => "article not found"]);
        }
        $cart = $user->myShoppingCart;
        //Noch kein Shopping Cart initialisiert
        if($cart == null){
            //Shopping Cart initialisieren
            $cart = new ab_shoppingcart();
            $cart->ab_creator_id = $creator_id;
            $cart->save();
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
                //Kontrolle ob noch Items im Warenkorb sind
                $count = $cart->myarticles->count();
                if($count == 0){
                    //Entfernen des Warenkorb
                    $cart->delete();
                }

                return response()->json(["success" => "article was removed from shopping cart"]);
            }
        }else{
            //Wenn kein Artikel gefunden wurde, kann der neue hinzugefügt werden
            $entry = new ab_shoppingcart_item();
            $entry->ab_shoppingcart_id = $cartID;
            $entry->ab_article_id = $articleID;
            $entry->save();
            return response()->json(["success" => "article was added to shopping cart"]);
        }        
    }

    public function deleteArticleFromShoppingCart($creator_id, $article_id, Request $request){
        /*
            Validierung
        */
        $user = User::find($creator_id);
        if(!$user){
            return response()->json(["error" => "user not found"]);
        }
        $articleID = intval($article_id);
        if(ab_article::find($articleID) == null){
            return response()->json(["error" => "article not found"]);
        }
        $cart = $user->myShoppingCart;
        //Noch kein Shopping Cart initialisiert
        if($cart == null){
            return response()->json(["error" => "cart not yet initialized - nothing to delete"]);
        }
        $cartID = $cart->id;
        
        //Aus Shopping Cart entfernen
        $articles = ab_shoppingcart_item::where('ab_shoppingcart_id','=',$cartID)
            ->where('ab_article_id','=',$articleID)->get();
        if($articles->count() == 0){
            return response()->json(["error" => "article not found in shopping cart"]);
        }
        else{
            foreach($articles as $article){
                $article->delete();
                return response()->json(["success" => "Article was removed"]);
            }   
        } 
    }

    //Wird nur aufgerufen, wenn der Warenkorb entfernt werden soll, weil z.B. keine Items mehr im Shop liegen
    public function buyShoppingCart_api($creator_id){
        $user = User::find($creator_id);
        if(!$user){
            return response()->json(["error" => "user not found"]);
        }
        $cart = $user->myShoppingCart;
        if($cart == null){
            return response()->json(["error" => "shopping cart not found"]);
        }
        else{
            $einträge = $cart->myarticles;
            foreach($einträge as $eintrag)
            {   
                $message = "Großartig! Ihr Artikel '" . $eintrag->article->first()->ab_name . "' wurde erfolgreich verkauft";
                $seller_id = $eintrag->article->first()->ab_creator_id;
                broadcast(new Sold($message,$seller_id,"test"));
                $eintrag->article()->delete();
            }
            $cart->myarticles()->delete();
        }
        return response()->json(["success" => "Article have been deleted and Shopping Cart was cleared"]);
    
    }
    
}
