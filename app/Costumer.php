<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    protected $fillable = [
        'name', 'last_name', 'email', 'active', 'image',
    ];
}
