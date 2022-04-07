<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ab_article;

class ab_articlecategory extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table = 'ab_articlecategory';
    protected $fillable=[
        'ab_name',
        'ab_description'
    ];


    public function articles(){
        return $this->belongsToMany(ab_article::class, 'ab_article_has_articlecategory', 'ab_articlecategory_id', 'ab_article_id');
    }
}
