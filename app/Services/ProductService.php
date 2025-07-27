<?php

namespace App\Services;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\Product\ProductRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;


class ProductService
{
    public function getAllProducts() {

        return Cache::remember('products_list', 60, function () {
            return Product::with('creator', 'categories')->orderByDesc('created_at')->paginate(9);
        });
    }

    public function getAllCategories()  {

        return Cache::remember('categories_list', 60, function () {
            return Category::all();
        });
    }

    public function getUserProducts($userId) {
        return Product::with('categories')
            ->where('created_by',$userId)->orderByDesc('created_at')->
            paginate(3);
    }

    public function storeProduct(ProductRequest $request, int $userId) {
        Cache::forget('products_list');
        Cache::forget('total_products');
        Cache::forget('product_trend');
        Cache::forget('category_product_counts');

        $data = $request->validated();

        $data['created_by'] = $userId;

        $this->storeMedia($request , $data);

        $product = Product::create($data);

        if ($request->filled('categories')) {
            syncProductCategories($product,$request->categories);
        }
        return $product;
    }
    public function updateProduct(ProductRequest $request, $product) {
        Cache::forget('products_list');
        Cache::forget('total_products');
        Cache::forget('product_trend');
        Cache::forget('category_product_counts');

        $data = $request->validated();

        $this->storeMedia($request , $data);

        $product->update($data);

        if ($request->filled('categories')) {
            syncProductCategories($product,$request->categories);
        }

    }

    public function storeMedia($request , array & $data){
        if ($request->hasFile('image')) {
            $data['media_id'] = uploadMedia($request->file('image') , 'products' , 'public');
        }
    }

    public function deleteProduct(Product $product) {
        Cache::forget('products_list');
        Cache::forget('total_products');
        Cache::forget('product_trend');
        Cache::forget('category_product_counts');

        if ($product->media_id) {
            Storage::disk('public')->delete($product->media->path);
            $product->media->delete();
        }

        $product->delete();
    }

}
