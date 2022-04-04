<?php

namespace App\Http\Controllers;

use App\Models\ab_article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function showAllArticle(){
        $articles = ab_article::all();
        return view('article')->with('articles',$articles);
    }
    public function showArticle(Request $request){
        
        $keyword = $request->search;
        $articles = ab_article::where('ab_name','ilike','%'.$keyword.'%')->get();
        return view('article')->with('articles',$articles);
    }
}
