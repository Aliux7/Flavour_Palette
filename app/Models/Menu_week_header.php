<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_week_header extends Model
{
    use HasFactory;

    public function menu_week_detail(){
        return $this->hasMany(menu_week_detail::class);
    }
}
