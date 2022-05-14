<?php

namespace App\Http\Controllers;

use App\Models\ab_article;
use App\Models\ab_articlecategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Response;
class ArticleController extends Controller
{
    //returned die Artikel View mit allen Artikeln
    public function showAllArticle(Request $request){
        if($request->search){
            $articles = ab_article::where('ab_name','ilike','%'.$request->search.'%')->get();
            return view('tailwind.Article.article')->with('articles',$articles)->with('headline',"Alle Artikel im Überblick");
        }
        //Alle Artikel
        $articles = ab_article::all();
        return view('tailwind.Article.article')->with('articles',$articles)->with('headline',"Alle Artikel im Überblick");
    }
    public function showMyArticle(Request $request){
        $articles = auth()->user()->myarticles;
        return view('tailwind.Article.article')->with('articles',$articles)->with('headline',"Meine Artikel im Überblick");
    }
    public function showNewArticleForm(Request $request){
        $categories = ab_articlecategory::all();
        return view('tailwind.Article.CreateArticle')->with('categories',$categories);
    }

    public function addArticle(Request $request){
        //1. Serverseitige-Validierung
        //-> Ab_Article hat keine Attribute, die unique sind

        $validator = $request->validate([
            'name'=>'required|unique:ab_article,ab_name',
            'price'=>'numeric|gt:0',
            'file.*' => 'mimes:png,jpg'
        ]);
        
        $article = new ab_article();
        $article->ab_name = $request->name;
        $article->ab_price = $request->price;
        if($request->description == null){
            $article->ab_description = "";
        }
        else{
            $article->ab_description = $request->description;
        }
        $article->ab_creator_id = $request->userID;
        $article->save();

        //3. Success oder Fehler zurückgeben
        return response()->json(['message' => 'success'],200);
    }

    public function deleteArticle(Request $request){
        $article = ab_article::where('id','like',$request->id)->first();
        if($article->ab_creator_id == Auth()->User()->id){
            ab_article::destroy($request->id);
        }
        if(File::exists(public_path('images/articlepictures/'.$request->id . '.png'))){
            File::delete(public_path('images/articlepictures/'.$request->id . '.png'));
        }
        if(File::exists(public_path('images/articlepictures/'.$request->id . '.jpg'))){
            File::delete(public_path('images/articlepictures/'.$request->id . '.jpg'));
        }

        return redirect()->back();
    }

    /*
        API ROUTEN
    */

    public function articles_api(Request $request){
        //Es wurde ein Suchbegriff angegeben
        if($request->search){
            //Suche in Datenbank nach Suchbegriff
            $articles = ab_article::where('ab_name','ilike','%'.$request->search.'%')->get();
            return response()->json(['articles'=>$articles], 200);
        }
        //Anfrage zur Erstellung eines Artikels wurde hochgeladen
        else if($request->input('name') != null && $request->input('price') != null && $request->input('creator_id') != null){
            //Validation
            if($request->input('price') <= 0 ){
                //Validierung fehlgeschlagen
                return response()->json(["Error" => "Preis ist <= 0"], 400);
            }
            if( ab_article::where('ab_name','like',$request->input('name'))->get()->count() > 0){
                //Validierung fehlgeschlagen
                return response()->json(["Error" => "Es existiert bereits ein Artikel unter diesem Namen"],403);
            }

            //Artikel anlegen
            $article = new ab_article();
            $article->ab_name = $request->input('name');
            $article->ab_price = doubleval($request->input('price'));
            $article->ab_description = $request->input('description') != null ? $request->input('description'): "";
            $article->ab_creator_id = $request->input('creator_id');
            $article->save();
            return response()->json([
                "ID" => $article->id, 
                "artikel"=>$article
            ]);
        }
        else{
            return ab_article::all();
        }
        
    }

    public function delete_api($id){
        $article = ab_article::find($id);
        
        if(!$article){
            return response([
                'message'=>'Artikel nicht gefunden'
            ],403);
        }
        $article->delete();

        return response([
            'message' => 'Artikel gelöscht'
        ],200);
        
    }

    
}
