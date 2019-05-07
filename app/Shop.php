<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['coordinates', 'address', 'phone', 'working', 'info'];
}
