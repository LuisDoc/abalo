<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\ab_article;
use App\Models\ab_shoppingcart;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table ='ab_user';
    protected $fillable=[
        'ab_name',
        'ab_password',
        'ab_mail',
        'ab_creator_id'
    ];
    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    public function password():Attribute{
        return Attribute::make(
            get:fn($value)=> $this->attributes['ab_password']
        );
    }
    public function email():Attribute{
        return Attribute::make(
            get:fn($value)=> $this->attributes['ab_mail']
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function myarticles(){
        return $this->hasMany(ab_article::class, 'ab_creator_id')->orderBy('ab_createdate', 'desc');
    }
    public function myShoppingCart(){
        return $this->hasOne(ab_shoppingcart::class, 'ab_creator_id');
    }
}
