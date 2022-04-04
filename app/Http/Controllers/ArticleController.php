<?php

namespace App\Http\Controllers;

use App\Models\ab_article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    //returned die Artikel View mit allen Artikeln
    public function showAllArticle(Request $request){
        if($request->search){
            $articles = ab_article::where('ab_name','ilike','%'.$request->search.'%')->get();
            return view('tailwind.article')->with('articles',$articles);
        }
        //Alle Artikel
        $articles = ab_article::all();
        return view('tailwind.article')->with('articles',$articles);
    }
    

    //returned die Artikel View mit Artikeln
    public function searchArticleLike(Request $request){
        //Alle Artikel, die das Keyword enthalten
        
    }
}
