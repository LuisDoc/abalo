<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ab_article;

class HomeController extends Controller
{
    public function getHome(){
        $articlePreview = ab_article::query()->orderBy('ab_createdate','desc')->limit(3)->get();
        
        return view('index')->with('articles',$articlePreview);
    }
}
