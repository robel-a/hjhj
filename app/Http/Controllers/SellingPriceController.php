<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BuyingPrice;
use App\Models\CustomTax;

class SellingPriceController extends Controller
{
    public function index($productId)
    {
        // Fetch all products
        $products = Product::all();

        // Calculate the total product price from the Product table
        $totalProductPrice = $products->sum(function ($product) {
            return $product->total_price;
        });

        // Retrieve the BuyingPrice record for the given product ID
        $buyingPrice = BuyingPrice::where('id', $productId)->firstOrFail();

        // Retrieve the CustomTax record for the given product ID
        $customTax = CustomTax::where('id', $productId)->firstOrFail();

        // Assuming you have `freight_value` and `insurance_value` in the BuyingPrice model
        $freightValue = $buyingPrice->freight_value;
        $insuranceValue = $buyingPrice->insurance_value;

        // Calculate the converted price
        $convertedPrice = $this->calculateConvertedPrice($totalProductPrice, $freightValue, $insuranceValue, $customTax->amount);

        // Return the response as JSON
        return response()->json([
            'totalProductPrice' => $totalProductPrice,
            'totalTax' => $customTax->amount, // Assuming `amount` is the tax amount in the CustomTax model
            'convertedPrice' => $convertedPrice,
            'productDetails' => $products,
        ], 200);
    }

    // Example method to calculate the converted price
    private function calculateConvertedPrice($totalProductPrice, $freightValue, $insuranceValue, $totalTax)
    {
        // Implement your conversion logic here
        // For example, summing up the total product price, freight, insurance, and tax
        return $totalProductPrice + $freightValue + $insuranceValue + $totalTax;
    }
}
