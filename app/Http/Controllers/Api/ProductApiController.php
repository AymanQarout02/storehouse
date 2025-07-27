<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{

    public function index()
    {
        return response()->json([
            'products' => Product::with('creator', 'categories')->orderByDesc('created_at')->paginate(9),
            'categories' => Category::all()
        ]);
    }

    public function myProducts()
    {
        $products = Product::with('categories')
            ->where('created_by', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(3);

        return response()->json([
            'products' => $products,
            'categories' => Category::all()
        ]);
    }

    public function show(Product $product)
    {
        return response()->json($product->load('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'categories' => 'nullable|string'
        ]);

        $data['created_by'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['media_id'] = uploadMedia($request->file('image'), 'products', 'public');
        }

        $product = Product::create($data);

        if ($request->filled('categories')) {
            syncProductCategories($product, $request->categories);
        }

        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'categories' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $data['media_id'] = uploadMedia($request->file('image'), 'products', 'public');
        }

        $product->update($data);

        if ($request->filled('categories')) {
            syncProductCategories($product, $request->categories);
        }

        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
