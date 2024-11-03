<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('stock-switch', [ProductController::class, 'stockSwitch'])->name('switch');


Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/create', [ProductController::class, 'create'])->name('create');
Route::post('/', [ProductController::class, 'store'])->name('store');

 Route::get('{id}/show', [ProductController::class, 'show'])->name('show');

Route::get('{product}/edit', [ProductController::class, 'edit'])->name('edit');
Route::patch('{product}', [ProductController::class, 'update'])->name('update'); // Alternative method for updating
Route::delete('{product}/delete', [ProductController::class, 'destroy'])->name('destroy');





// routes/web.php

Route::get('/search-product', [ProductController::class, 'searchProduct'])->name('search.product');

Route::get('/check-quantity', [ProductController::class, 'checkQuantity'])->name('check.quantity');


Route::get('add', [ProductController::class, 'add'])->name('add');
Route::get('purchase', [ProductController::class, 'purchased'])->name('purchased');
Route::get('all-products', [ProductController::class, 'allProducts'])->name('allProducts');

Route::get('review', [ProductController::class, 'review'])->name('review');


Route::post('/bulk-delete', [ProductController::class, 'bulkDelete'])->name('bulk-delete');
Route::post('/bulk-unpublish', [ProductController::class, 'bulkUnpublish'])->name('bulk-unpublish');
Route::post('/bulk-publish', [ProductController::class, 'bulkPublish'])->name('bulk-publish');
// fillter product
Route::post('/filter', [ProductController::class, 'filterAllProducts'])->name('filter');
 Route::Post('/new-arrival', [ProductController::class, 'newArrival'])->name('new-arrival');

Route::prefix('coupon')->as('coupon.')->group(function () {
    Route::get('/', [ProductController::class, 'coupon'])->name('index');
    Route::get('create', [ProductController::class, 'couponCreate'])->name('create');
    Route::post('/', [ProductController::class, 'couponStore'])->name('store');
    Route::get('/attach', [ProductController::class, 'couponAttach'])->name('attach.index');
    Route::post('/attach', [ProductController::class, 'productCuponSync'])->name('attach.update');
    Route::get('/{coupon}/product-and-cupon-edit', [ProductController::class, 'productCuponEdit'])->name('attach.edit');

    Route::get('/{coupon}/edit', [ProductController::class, 'cuponEdit'])->name('edit');
    Route::patch('/{coupon}/update', [ProductController::class, 'couponUpdate'])->name('update');
    Route::delete('/{coupon}/delete', [ProductController::class, 'couponDestroy'])->name('destroy');


    // dulk 

    // In web.php (routes file)

});
