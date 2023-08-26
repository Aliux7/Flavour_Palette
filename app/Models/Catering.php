<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catering extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string',
        'seller_id' => 'string'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function menu(){
        return $this->hasMany(Menu::class, 'catering_id');
    }
}
