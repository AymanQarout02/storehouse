<?php


namespace App\Http\Controllers\Category;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{

    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }


    public function index()
    {
        $categories = Category::withCount('products')->orderByDesc('created_at')->paginate(9);

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $products = $this->categoryService->getCategoryProducts($category);

        $categories = $this->categoryService->getAllCategories();

        return view('categories.index', [
            'products' => $products,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    public function list()
    {
        $categories = $this->categoryService->listCategories();

        return view('categories.list', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }
    public function store(Request $request)
    {
        $this->categoryService->storeCategory($request);

        return redirect()->route('categories.list')->with('success', 'Category created successfully.');
    }
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->categoryService->updateCategory($request, $category);

        return redirect()->route('categories.list')->with('success', 'Category updated successfully.');
    }
    public function destroy(Category $category)
    {
        $flag = $this->categoryService->deleteCategory($category);
        if($flag)
            return redirect()->route('categories.list')->with('success', 'Category deleted successfully.');
        else
            return redirect()->route('categories.delete')->with('error', 'Category cannot be deleted because it have products associated with it.');
    }



}
