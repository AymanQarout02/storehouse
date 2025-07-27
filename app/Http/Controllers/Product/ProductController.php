<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\ProductService;

class ProductController extends Controller
{

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {

        $products = $this->productService->getAllProducts();

        $categories = $this->productService->getAllCategories();

        return view('products.index', compact('products', 'categories'));
    }

    public function myProducts()
    {
        $products = $this->productService->getUserProducts(auth()->id());

        $categories = $this->productService->getAllCategories();

        return view('products.my_products', compact('products' , 'categories'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }
    public function store(ProductRequest $request)
    {
        $this->productService->storeProduct($request , auth()->id());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->productService->updateProduct($request, $product);

        return redirect()->route('products.my_products')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return redirect()->route('products.my_products')->with('success', 'Product deleted successfully.');
    }

}
