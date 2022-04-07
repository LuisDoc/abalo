<?php

namespace App\Http\Controllers;

use App\Models\ab_article;
use App\Models\ab_articlecategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
class ArticleController extends Controller
{
    //returned die Artikel View mit allen Artikeln
    public function showAllArticle(Request $request){
        if($request->search){
            $articles = ab_article::where('ab_name','ilike','%'.$request->search.'%')->get();
            return view('tailwind.Article.article')->with('articles',$articles)->with('headline',"Alle Artikel im Überblick");
        }
        //Neuer Artikel wird angelegt
        else if($request->name){
            $request->validate([
                'name'=>'required|unique:ab_article,ab_name',
                'price'=>'numeric|gt:0',
                'file.*' => 'mimes:png,jpg'
            ]);

            
            //Neuen Artikel anlegen
            $article = new ab_article();
            $article->ab_name = $request->name;
            $article->ab_price = $request->price;
            
            if($request->description == null){
                $article->ab_description = "";
            }
            else{
                $article->ab_description = $request->description;
            }
            
            $article->ab_creator_id = auth()->user()->id;

            $article->save();
            
            if($request->hasFile('file')){
                $fileName= $article->id .'.'. $request->file('file')->getClientOriginalExtension();
                $request->file('file')->move('images/articlepictures', $fileName);
            }
            return redirect("/myarticle");
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
    
}
