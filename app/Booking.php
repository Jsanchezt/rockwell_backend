<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking  extends Model
{


    protected $table = "booking";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service','staff','date','select_time','name','email','phone','message'
    ];



}
