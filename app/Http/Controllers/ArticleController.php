<?php

namespace App\Http\Controllers;

use App\Models\ab_article;
use App\Models\ab_articlecategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
