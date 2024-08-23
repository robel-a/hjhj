<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'invoices';

    // The attributes that are mass assignable.
    protected $fillable = [
        'reference_number',
        'product_details',
        'total_tax',
        'converted_price',
        'selling_price',
    ];

    // Cast attributes to specific types.
    protected $casts = [
        'product_details' => 'array', // Automatically cast JSON to array
        'total_tax' => 'decimal:2',
        'converted_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
    ];
}
