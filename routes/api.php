<?php

use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('{cat_id}/subcategory-all', function ($cat_id) {
    $data = ProductSubCategory::where('category_id', $cat_id)->get();
    return ('SDFSEDF');
})->name('subcategory-all');
