<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'allowed_units',
        'unit_limits'
    ];

    protected $casts = [
        'allowed_units' => 'array',
        'unit_limits' => 'array'
    ];
}
