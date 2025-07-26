<?php


use App\Models\Category;

if(!function_exists('syncProductCategories')) {
    function syncProductCategories($product ,$categoryNames)
    {
        $categoryNames = collect(explode(',', $categoryNames))
            ->map(fn($cat) => trim($cat))
            ->filter();

        $categoryIds = [];
        foreach ($categoryNames as $name) {
            $category = Category::firstOrCreate(['name' => $name]);
            $categoryIds[] = $category->id;
        }

        $product->categories()->sync($categoryIds);
    }
}
