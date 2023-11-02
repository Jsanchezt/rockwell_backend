<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        "name", "price", "brand", "category", "best_seller",
        "available","color","ranking","description","old_price","image_principal","images","video"
    ];

    protected $attributes = [
        'best_seller' => false,
        'available' => true,
        'ranking' => 5,
        'video' => "",
        'images' => "[]",
    ];
}
