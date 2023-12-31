<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function catering(){
        return $this->belongsTo(Catering::class, 'catering_id');
    }

    public function review(){
        return $this->hasMany(Review::class, 'menu_id');
    }

    public function menu_category(){
        return $this->hasMany(Menu_category::class, 'menu_id');
    }

    public function menu_week_detail(){
        return $this->hasMany(menu_week_detail::class, 'menu_id');
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function wishlist(){
        return $this->hasMany(wishlist::class);
    }


}
