<?php

namespace App\Helpers;

use App\Models\ProductCategory;

class CategoryHelper
{
    public static function getCategoriesWithSubcategories()
    {
        return ProductCategory::with('subcategories')->get();
    }

    public static function getCategoryWithSubcategoriesBySlug($slug)
    {
        return ProductCategory::with('subcategories')->where('slug', $slug)->first();
    }
}
