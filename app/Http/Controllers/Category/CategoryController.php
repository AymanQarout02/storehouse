<?php


namespace App\Http\Controllers\Category;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{

    public function index( Category $category)
    {
        $products = $category->products()->orderByDesc('created_at')->paginate(9);

        $categories = Category::all();

        return view('categories.index', [
            'products' => $products,
            'category' => $category,
            'categories' => $categories,
        ]);
    }
    public function destroy(Category $category)
    {
        Cache::forget('total_categories');
        Cache::forget('category_product_counts');

        if($category->products()->count() > 0) {
            return redirect()->route('category.delete')->with('error', 'Category cannot be deleted because it have products associated with it.');
        }else {
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
        }
    }



}
