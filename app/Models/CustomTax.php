<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomTax extends Model
{
    use HasFactory;
protected $table = 'custom_tax'; 
    protected $fillable = [
        'total_product_price',
        'freight_value',
        'insurance_value',
        'exchange_rate',
        'duty_value',
        'sur_value',
        'vat_value',
        'excise_value',
        'withholding_value',
        'social_value',
        'total_freight',
        'total_insurance',
        'total_duties',
        'total_excise',
        'total_vat',
        'total_sur',
        'total_withholding',
        'total_social',
        'total_tax',
        'cif',
        'products',
        'product_details',
    ];

    protected $casts = [
        'products' => 'array',
        'product_details' => 'array',
    ];
}
