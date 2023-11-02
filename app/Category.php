<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'category';

    protected $fillable = ['name', 'code', 'image'];

    protected $attributes = [
        'image' => "",
    ];

}
