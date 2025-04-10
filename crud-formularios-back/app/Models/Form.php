<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $connection = 'mongodb';
    protected $fillable = ['nombre', 'campos'];

    protected $casts = [
        'campos' => 'array',
    ];
}
