<?php


namespace App\Http\Controllers\Category;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::withCount('products')->orderByDesc('created_at')->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $products = $category->products()->orderByDesc('created_at')->paginate(9);
        $categories = Category::all();
        return view('categories.index', [
            'products' => $products,
            'category' => $category,
            'categories' => $categories,
        ]);
    }
    public function list()
    {
        $categories = Category::withCount('products')->orderByDesc('created_at')->paginate(10);

        return view('categories.list', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Cache::forget('total_categories');
        Cache::forget('category_product_counts');

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.list')->with('success', 'Category created successfully.');
    }
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        Cache::forget('total_categories');
        Cache::forget('category_product_counts');

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.list')->with('success', 'Category updated successfully.');
    }
    public function destroy(Category $category)
    {
        Cache::forget('total_categories');
        Cache::forget('category_product_counts');

        if($category->products()->count() > 0) {
            return redirect()->route('categories.delete')->with('error', 'Category cannot be deleted because it have products associated with it.');
        }

        $category->delete();
        return redirect()->route('categories.list')->with('success', 'Category deleted successfully.');

    }



}
