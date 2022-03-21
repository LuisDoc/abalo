<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_user extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table = 'ab_user';
    protected $fillable=[
        'ab_name',
        'ab_password',
        'ab_mail'
    ];
}
