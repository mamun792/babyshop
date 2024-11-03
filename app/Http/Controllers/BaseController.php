<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;

class BaseController extends Controller
{
    protected $categoryService;
    protected $categories;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->categories = $this->categoryService->getCategoriesWithSubcategories();
    }

}
