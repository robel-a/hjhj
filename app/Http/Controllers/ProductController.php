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
}
