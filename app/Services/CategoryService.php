<?php

namespace App\Services;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryService
{

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getCategoryProducts( Category $category)
    {
        return $category->products()->orderByDesc('created_at')->paginate(9);

    }

    public function listCategories()
    {
        return Category::withCount('products')->orderByDesc('created_at')->paginate(9);
    }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Cache::forget('total_categories');
        Cache::forget('category_product_counts');

        $category = Category::create([
            'name' => $request->name,
        ]);

        return $category;
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        Cache::forget('total_categories');
        Cache::forget('category_product_counts');

        $category->update([
            'name' => $request->name,
        ]);

        return $category;
    }

    public function deleteCategory(Category $category) : bool
    {
        if($category->products()->count() > 0) {
            return false;
        }

        Cache::forget('total_categories');
        Cache::forget('category_product_counts');
        $category->delete();

        return true;
    }

}
