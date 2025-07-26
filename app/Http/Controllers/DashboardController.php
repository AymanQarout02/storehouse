<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{



    public function index()
    {
        $totalProducts = Cache::remember('total_products', 60, function () {
            return Product::count();
        });

        $totalCategories = Cache::remember('total_categories', 60, function () {
            return Category::count();
        });

        $totalUsers = Cache::remember('total_users', 60, function () {
            return User::count();
        });

        $productTrend = Cache::remember('product_trend', 60, function () {
            return Product::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
                ->where('created_at', '>=', now()->subDays(7))
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('count', 'date');
        });

        $categoryProductCounts = Cache::remember('category_product_counts', 60, function () {
            return Category::withCount('products')
                ->orderBy('products_count', 'desc')
                ->pluck('products_count', 'name');
        });

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'productTrend',
            'categoryProductCounts'
        ));
    }
}
