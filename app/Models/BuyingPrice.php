<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingPrice extends Model
{
    use HasFactory;
     protected $fillable = [
        'products',
        'product_details',
        'total_product_price',
        'freight_value',
        'insurance_value',
        'converted_price',
        'amount_in_birr',
        'exchange_rate',
    ];

    protected $casts = [
        'products' => 'array',
        'product_details' => 'array',
    ];
}
