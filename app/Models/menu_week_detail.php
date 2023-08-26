<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu_week_detail extends Model
{
    use HasFactory;

    public function menu_week_header(){
        return $this->belongsTo(Menu_week_header::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
