<?php

namespace App\Http\Controllers;

use App\Models\BuyingPrice;
use Illuminate\Http\Request;

class BuyingPriceController extends Controller
{
    public function store(Request $request)
    {
        $validatedData =$request->validate([
            'products' => 'required|array',
            'productDetails' => 'required|array',
            'totalProductPrice' => 'required|numeric',
            'freightValue' => 'required|numeric',
            'exchangeRate'=>'required|numeric',
            'insuranceValue' => 'required|numeric',
            'convertedPrice' => 'required|numeric',
             'amountInBirr' => 'required|numeric',
        ]);

        $buyingPrice = BuyingPrice::create([
            'total_product_price' => $request->input('totalProductPrice'),
            'freight_value' => $request->input('freightValue'),
            'insurance_value' => $request->input('insuranceValue'),
            'converted_price' => $request->input('convertedPrice'),
             'exchange_rate' => $request->input('exchangeRate'),
              'amount_in_birr' => $request->input('amountInBirr'),
               'products' => json_encode($validatedData['products']), // Ensure proper storage
            'product_details' => json_encode($validatedData['productDetails']),
        ]);

        return response()->json($buyingPrice, 201);
    }

     public function getTotalProductPrice($productId)
    {
         // Retrieve the BuyingPrice record
        $buyingPrice = BuyingPrice::findOrFail($productId);

        // Check if record is found
        if (!$buyingPrice) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Return the total_product_price
        return response()->json([
            'converted_price' => $buyingPrice->converted_price,
        ], 200);
    }
   
    public function getCIF($productId)
    {
        // Retrieve the BuyingPrice record
        $buyingPrice = BuyingPrice::findOrFail($productId);

        // Check if record is found
        if (!$buyingPrice) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Return the total_product_price
        return response()->json([
            'converted_price' => $buyingPrice->converted_price,
        ], 200);
    }
   

}

