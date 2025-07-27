<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{

    public function index()
    {
        $products = Cache::remember('products_list', 60, function () {
            return Product::with('creator', 'categories')->orderByDesc('created_at')->paginate(9);
        });

        $categories = Cache::remember('categories_list', 60, function () {
            return Category::all();
        });

        return view('products.index', compact('products', 'categories'));
    }
    public function myProducts()
    {
        $products = Product::with('categories')
            ->where('created_by', auth()->id())->orderByDesc('created_at')->
            paginate(3);

        $categories = Category::all();

        return view('products.my_products', compact('products' , 'categories'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
    public function update(ProductRequest $request, Product $product)
    {
        Cache::forget('products_list');
        Cache::forget('total_products');
        Cache::forget('product_trend');
        Cache::forget('category_product_counts');


        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('products', 'public');

            $media = Media::create([
                'file_name'  => $file->getClientOriginalName(),
                'file_path'  => $filePath,
                'file_type'  => $file->getClientMimeType(),
                'file_size'  => $file->getSize(),
                'created_by' => auth()->id(),
            ]);

            $data['media_id'] = $media->id;
        }

        $product->update($data);

        if ($request->filled('categories')) {
            $categoryNames = collect(explode(',', $request->categories))
                ->map(fn($cat) => trim($cat))
                ->filter();

            $categoryIds = [];
            foreach ($categoryNames as $name) {
                $category = Category::firstOrCreate(['name' => $name]);
                $categoryIds[] = $category->id;
            }

            $product->categories()->sync($categoryIds);
        }

        return redirect()->route('products.my_products')->with('success', 'Product updated successfully.');
    }

    public function create()
    {
        return view('products.create');
    }
    public function store(ProductRequest $request)
    {
        Cache::forget('products_list');
        Cache::forget('total_products');
        Cache::forget('product_trend');
        Cache::forget('category_product_counts');

        $data = $request->validated();
        $data['created_by'] = auth()->id();


        if ($request->hasFile('image')) {
            $data['media_id'] = uploadMedia($request->file('image') , 'products' , 'public');
        }

        $product = Product::create($data);

        if ($request->filled('categories')) {
            syncProductCategories($product,$request->categories);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function destroy(Product $product)
    {
        Cache::forget('products_list');
        Cache::forget('total_products');
        Cache::forget('product_trend');
        Cache::forget('category_product_counts');

        $product->delete();
        return redirect()->route('products.my_products')->with('success', 'Product deleted successfully.');
    }

}
