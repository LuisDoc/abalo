<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_articlecategory extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table = 'ab_articlecategory';
    protected $fillable=[
        'ab_name',
        'ab_description'
    ];
}
