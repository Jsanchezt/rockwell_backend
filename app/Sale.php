<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    protected $table = 'sales';

    protected $fillable = ['name', 'email', 'phone', 'address', 'products', 'status','total', 'user_id'];

    protected $casts =[
        'products' => 'array',
    ];

}
