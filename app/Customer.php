<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'surname', 'patronymic', 'phone', 'card_number', 'sum', 'percent', 'registered'];
}
