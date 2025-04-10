<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Form extends Eloquent
{
    protected $connection = 'mongodb';

    protected $collection = 'forms';
    protected $fillable = ['nombre', 'campos'];

    protected $casts = [
        'campos' => 'array',
    ];
}
