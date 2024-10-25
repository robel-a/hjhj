<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CustomTax;
use App\Models\BuyingPrice;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Get reports based on the report type.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReports(Request $request)
    {
        $type = $request->query('type');

        if ($type === 'customTax') {
            // Fetch reports from the `custom_tax` table
            $reports = CustomTax::all()->map(function ($report) {
                return $this->formatCustomTaxReport($report);
            });
        } elseif ($type === 'buying') {
            // Fetch reports from the `buying_prices` table
            $reports = BuyingPrice::all()->map(function ($report) {
                return $this->formatBuyingPriceReport($report);
            });
        } else {
            return response()->json(['error' => 'Invalid report type'], 400);
        }

        return response()->json($reports);
    }

    // Format CustomTax report
    private function formatCustomTaxReport($report)
    {
        return [
            'id' => $report->id,
            'total_product_price' => $report->total_product_price,
            'freight_value' => $report->freight_value,
            'insurance_value' => $report->insurance_value,
            'exchange_rate' => $report->exchange_rate,
            'duty_value' => $report->duty_value,
            'sur_value' => $report->sur_value,
            'vat_value' => $report->vat_value,
            'excise_value' => $report->excise_value,
            'withholding_value' => $report->withholding_value,
            'social_value' => $report->social_value,
            'total_freight' => $report->total_freight,
            'total_insurance' => $report->total_insurance,
            'total_duties' => $report->total_duties,
            'total_excise' => $report->total_excise,
            'total_vat' => $report->total_vat,
            'total_sur' => $report->total_sur,
            'total_withholding' => $report->total_withholding,
            'total_social' => $report->total_social,
            'total_tax' => $report->total_tax,
            'cif' => $report->cif,
            'products' => $report->products, // No need to decode if already an array
            'product_details' => $this->extractProductDetails($report->product_details),
            'created_at' => $report->created_at->toDateTimeString(),
            'updated_at' => $report->updated_at->toDateTimeString(),
        ];
    }

    // Format BuyingPrice report
    private function formatBuyingPriceReport($report)
    {
        return [
            'id' => $report->id,
            'total_product_price' => $report->total_product_price,
            'freight_value' => $report->freight_value,
            'insurance_value' => $report->insurance_value,
            'exchange_rate' => $report->exchange_rate,
            'converted_price' => $report->converted_price,
            'amount_in_birr' => $report->amount_in_birr,
            'total_tax' => $report->total_tax,
            'products' => $report->products, // No need to decode if already an array
            'product_details' => $this->extractProductDetails($report->product_details),
            'created_at' => $report->created_at->toDateTimeString(),
            'updated_at' => $report->updated_at->toDateTimeString(),
        ];
    }

    /**
     * Extract and format product details.
     *
     * @param mixed $productDetails
     * @return array
     */
    private function extractProductDetails($productDetails)
{
    // Check if $productDetails is a string (i.e., JSON), and decode it if so
    if (is_string($productDetails)) {
        $productDetails = json_decode($productDetails, true);
    }

    // Ensure $productDetails is an array, or return an empty array if null
    $productDetails = is_array($productDetails) ? $productDetails : [];

    // Debugging
    Log::debug('Product Details:', $productDetails);

    // Extract relevant information
    return array_map(function ($detail) {
        return [
            'name' => $detail['name'] ?? 'N/A',
            'price' => $detail['price'] ?? 'N/A',
            'quantity' => $detail['quantity'] ?? 'N/A',
        ];
    }, $productDetails);
}


    /**
     * Store a new report in the appropriate table based on the report type.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeReport(Request $request)
    {
        $type = $request->input('report_type');

        if ($type === 'customTax') {
            // Store data in the `custom_tax` table
            $report = CustomTax::create($request->all());
        } elseif ($type === 'buying') {
            // Store data in the `buying_prices` table
            $report = BuyingPrice::create($request->all());
        } else {
            return response()->json(['error' => 'Invalid report type'], 400);
        }

        return response()->json($report, 201);
    }

    public function destroy(Request $request, $id)
{
    $type = $request->query('type');

    try {
        // Start a database transaction to ensure all deletions are successful or rollback
        DB::beginTransaction();

        // Delete the report from the corresponding table
        if ($type === 'customTax') {
            $report = CustomTax::findOrFail($id);
            $report->delete();
        } elseif ($type === 'buying') {
            $report = BuyingPrice::findOrFail($id);
            $report->delete();
        } else {
            return response()->json(['error' => 'Invalid report type'], 400);
        }

        // Delete the associated product from the `products` table
        $product = Product::find($id); // Assuming `id` is the same for products table
        if ($product) {
            $product->delete();
        }

        // Commit the transaction
        DB::commit();

        return response()->json(['message' => 'Report and associated product deleted successfully'], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        DB::rollBack(); // Rollback transaction if a model is not found
        return response()->json(['error' => 'Report not found'], 404);
    } catch (\Exception $e) {
        DB::rollBack(); // Rollback transaction if any exception occurs
        Log::error('Error deleting report and product: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to delete report and product. Please try again.'], 500);
    }
}

}
