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

        $page = request('page', 1);

        return Cache::remember("products_list_page_{$page}", 60, function () {
            return Product::with('creator', 'categories')
                ->orderByDesc('created_at')
                ->paginate(9);
        });
    }

    public function getAllCategories()  {

        return Cache::remember('categories_list', 3600, function () {
            return Category::all();
        });
    }

    public function getUserProducts($userId) {
        return Product::with('categories')
            ->where('created_by',$userId)->orderByDesc('created_at')->
            paginate(3);
    }

    public function storeProduct($data, int $userId) {

        $data['created_by'] = $userId;

        if (isset($data['image']) && $data['image']) {
            $data['media_id'] = uploadMedia($data['image']);
        }else{
            $data['media_id'] = null;
        }

        $product = Product::create($data);

        if ($data['categories']) {
            $product->categories()->sync($data['categories']);
        }
        return $product;
    }
    public function updateProduct($data, $product) {

        if (isset($data['image'])) {
            $data['media_id'] = uploadMedia($data['image']);
        }else{
            $data['media_id'] = $product->media_id;
        }
        $product->update($data);

        if ($data['categories']) {
            $product->categories()->sync($data['categories']);
        }

    }

    public function deleteProduct(Product $product) {

        if ($product->media_id) {
            Storage::disk('public')->delete($product->media->path);
            $product->media->delete();
        }

        $product->delete();
    }

}
