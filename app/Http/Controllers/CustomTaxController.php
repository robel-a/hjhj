<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomTax;

class CustomTaxController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'totalProductPrice' => 'required|numeric',
            'freightValue' => 'required|numeric',
            'insuranceValue' => 'required|numeric',
            'exchangeRate' => 'required|numeric',
            'dutyValue' => 'required|numeric',
            'surValue' => 'required|numeric',
            'vatValue' => 'required|numeric',
            'exciseValue' => 'required|numeric',
            'withholdingValue' => 'required|numeric',
            'socialValue' => 'required|numeric',
            'totalFreight' => 'required|numeric',
            'totalInsurance' => 'required|numeric',
            'totalDuties' => 'required|numeric',
            'totalExcise' => 'required|numeric',
            'totalVAT' => 'required|numeric',
            'totalSUR' => 'required|numeric',
            'totalWithholding' => 'required|numeric',
            'totalSocial' => 'required|numeric',
            'totalTax' => 'required|numeric',
            'cif' => 'required|numeric',
            'products' => 'required|array',
            'productDetails' => 'required|array',
        ]);

        // Create a new CustomTax entry
        $customTax = CustomTax::create([
            'total_product_price' => $validatedData['totalProductPrice'],
            'freight_value' => $validatedData['freightValue'],
            'insurance_value' => $validatedData['insuranceValue'],
            'exchange_rate' => $validatedData['exchangeRate'],
            'duty_value' => $validatedData['dutyValue'],
            'sur_value' => $validatedData['surValue'],
            'vat_value' => $validatedData['vatValue'],
            'excise_value' => $validatedData['exciseValue'],
            'withholding_value' => $validatedData['withholdingValue'],
            'social_value' => $validatedData['socialValue'],
            'total_freight' => $validatedData['totalFreight'],
            'total_insurance' => $validatedData['totalInsurance'],
            'total_duties' => $validatedData['totalDuties'],
            'total_excise' => $validatedData['totalExcise'],
            'total_vat' => $validatedData['totalVAT'],
            'total_sur' => $validatedData['totalSUR'],
            'total_withholding' => $validatedData['totalWithholding'],
            'total_social' => $validatedData['totalSocial'],
            'total_tax' => $validatedData['totalTax'],
            'cif' => $validatedData['cif'],
            'products' => json_encode($validatedData['products']), // Ensure proper storage
            'product_details' => json_encode($validatedData['productDetails']),
        ]);

        return response()->json($customTax, 201);
    }
}
