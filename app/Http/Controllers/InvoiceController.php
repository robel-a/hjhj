<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log; // Optional for logging

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'referenceNumber' => 'required|string|unique:invoices,reference_number',
            'productDetails' => 'required|array',
            'totalTax' => 'required|numeric',
            'convertedPrice' => 'required|numeric',
            'sellingPrice' => 'required|numeric',
        ]);

        try {
            // Create a new invoice record
            $invoice = Invoice::create([
                'reference_number' => $validated['referenceNumber'],
                'product_details' => json_encode($validated['productDetails']),
                'total_tax' => $validated['totalTax'],
                'converted_price' => $validated['convertedPrice'],
                'selling_price' => $validated['sellingPrice'],
            ]);

            // Return a response
            return response()->json([
                'success' => true,
                'message' => 'Invoice created successfully',
                'data' => $invoice,
            ], 201); // HTTP status code 201 Created

        } catch (\Exception $e) {
            // Log the error (optional)
            Log::error('Error creating invoice: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to create invoice',
                'error' => $e->getMessage(),
            ], 500); // HTTP status code 500 Internal Server Error
        }
    }

    public function getInvoiceReferences()
    {
        // Retrieve only the invoice references from the database
        $references = Invoice::pluck('reference_number');
        
        // Return the references as a JSON response
        return response()->json($references);
    }

    /**
     * Fetch invoice details based on the reference number.
     *
     * @param  string  $reference
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInvoiceData($reference)
    {
        // Find the invoice by reference number
        $invoice = Invoice::where('reference_number', $reference)->first();

        if (!$invoice) {
            // Return a 404 response if the invoice is not found
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        // Return the invoice details as a JSON response
        return response()->json($invoice);
    }

}

