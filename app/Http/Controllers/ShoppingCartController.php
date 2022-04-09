<?php

namespace App\Http\Controllers;

use App\Models\ab_article;
use App\Models\ab_articlecategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShoppingCartController extends Controller
{
    public function getShoppingCart(){        
        return view('tailwind.shoppingCart')->with('articles',ab_article::all());
    }
}
