<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_header extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_detail(){
        return $this->hasMany(Order_detail::class, 'order_id');
    }
}
