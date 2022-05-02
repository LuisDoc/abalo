<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\ab_shoppingcart_item;
use App\Models\ab_articlecategory;
use App\Models\User;
class ab_article extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table = 'ab_article';
    protected $fillable=[
        'ab_name',
        'ab_price',
        'ab_description',
        'ab_creator_id',
        'ab_createdate'
    ];

    protected function abprice(): Attribute
    {
        return new Attribute(
            set: fn ($value) => intval($value * 100),
            get: fn($value) => doubleval($value/100),
        );
    }

    public function categories(){
        return $this->belongsToMany(ab_articlecategory::class,  'ab_article_has_articlecategory', 'ab_article_id','ab_articlecategory_id');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'ab_creator_id');
    }

}
