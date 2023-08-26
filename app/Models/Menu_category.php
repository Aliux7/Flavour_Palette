<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu_category extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function menu(){
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function category(){
        return $this->belongsTo(category::class, 'category_id');
    }
}
