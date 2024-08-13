<?php

namespace App\Http\Controllers;

use App\Models\BuyingPrice;
use Illuminate\Http\Request;

class BuyingPriceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'totalProductPrice' => 'required|numeric',
            'freightValue' => 'required|numeric',
            'insuranceValue' => 'required|numeric',
            'convertedPrice' => 'required|numeric',
        ]);

        $buyingPrice = BuyingPrice::create([
            'products' => $request->input('products'),
            'total_product_price' => $request->input('totalProductPrice'),
            'freight_value' => $request->input('freightValue'),
            'insurance_value' => $request->input('insuranceValue'),
            'converted_price' => $request->input('convertedPrice'),
        ]);

        return response()->json($buyingPrice, 201);
    }
}
