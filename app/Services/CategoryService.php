<?php

namespace App\Services;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    public function getCategoriesWithSubcategories()
    {
        return Cache::remember('categories_with_subcategories', 60, function () {
            return ProductCategory::with('subcategories')
                ->has('subcategories')
                ->latest()
                ->take(14)
                ->get();
        });
    }
}