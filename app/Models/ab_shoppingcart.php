<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ab_shoppingcart_item;
class ab_shoppingcart extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable=[
        "ab_creator_id",
    ];

    public function myarticles(){
        return $this->hasMany(ab_shoppingcart_item::class, 'ab_creator_id')->orderBy('ab_createdate', 'desc');
    }
}
