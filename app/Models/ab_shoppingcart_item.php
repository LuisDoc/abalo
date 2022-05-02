<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ab_shoppingcart;
use App\Models\ab_article;
class ab_shoppingcart_item extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable=[
        "ab_shoppingcart_id",
    ];
    protected $table="ab_shoppingcart_item";

    public function article(){
        return $this->hasMany(ab_article::class,"id","ab_article_id");
    }

    public function cart(){
        return $this->belongsTo(ab_shoppingcart::class,"ab_shoppingcart_id");
    }
    
    
}
