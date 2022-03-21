<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
