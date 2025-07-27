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
    public function storeCategory($data)
    {
        return Category::create([
            'name' => $data['name'],
        ]);
    }

    public function updateCategory($data, Category $category)
    {

        $category->update([
            'name' => $data['name'],
        ]);

        return $category;
    }

    public function deleteCategory(Category $category) : bool
    {
        if($category->products()->count() > 0) {
            return false;
        }

        $category->delete();

        return true;
    }

}
