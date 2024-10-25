<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $products = $request->input('products');

        foreach ($products as $productData) {
            Product::create($productData);
        }

        return response()->json(['message' => 'Products saved successfully.']);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }


public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'sometimes|string|max:255',
        'price' => 'sometimes|numeric',
        'quantity' => 'sometimes|integer',
        'total_price' => 'sometimes|numeric',
    ]);

    $product = Product::findOrFail($id);
    $product->update($validatedData);
    return response()->json($product);
}


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }

public function getProductById($productId)
{
    try {
        // Fetch the product by its ID
        $product = Product::findOrFail($productId);

        // Return the product details as a JSON response
        return response()->json([
            'product' => $product,
        ], 200);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Handle the case where the product is not found
        return response()->json([
            'error' => 'Product not found',
        ], 404);
    } catch (\Exception $e) {
        // Handle any other errors
        return response()->json([
            'error' => 'An error occurred while retrieving the product',
        ], 500);
    }
}

}

