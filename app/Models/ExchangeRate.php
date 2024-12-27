<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $fillable = [
        'currency_code',
        'currency_name',
        'rate',
        'nominal',
        'date',
    ];

    protected $casts = [
        'rate' => 'float',
        'nominal' => 'integer',
        'date' => 'date',
    ];
}
