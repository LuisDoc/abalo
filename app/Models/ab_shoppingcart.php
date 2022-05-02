<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ab_shoppingcart_item;
use App\Models\User;
class ab_shoppingcart extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable=[
        "ab_creator_id",
    ];
    protected $table= "ab_shoppingcart";

    public function myarticles(){
        return $this->hasMany(ab_shoppingcart_item::class, 'ab_shoppingcart_id');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'ab_creator_id');
    }
}
