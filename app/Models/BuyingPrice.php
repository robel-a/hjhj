<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingPrice extends Model
{
    use HasFactory;
     protected $fillable = [
        'products',
        'total_product_price',
        'freight_value',
        'insurance_value',
        'converted_price',
    ];

    protected $casts = [
        'products' => 'array',
    ];
}
