<?php

use App\Http\Controllers\ProductPurchaseController;
use Illuminate\Support\Facades\Route;


    Route::get('/', [ProductPurchaseController::class, 'index'])->name('index');
    Route::get('create', [ProductPurchaseController::class, 'create'])->name('create');
    Route::post('/', [ProductPurchaseController::class, 'store'])->name('store');
    Route::get('{id}/edit', [ProductPurchaseController::class, 'edit'])->name('edit');
    Route::patch('{purchase}/update', [ProductPurchaseController::class, 'update'])->name('update');
    Route::delete('{id}', [ProductPurchaseController::class, 'destroy'])->name('destroy');
    Route::post('add-product-to-purchase', [ProductPurchaseController::class, 'addProductToPurchase'])->name('addProductToPurchase');
    
    Route::get('{purchase}/add-purchase-items', [ProductPurchaseController::class, 'items_purchase'])->name('addPurchaseItems');
    Route::post('add-purchase-items', [ProductPurchaseController::class, 'items_purchase_store'])->name('items_purchase_store');

    // Route::get('{id}/add-product-purchase/edit', [ProductPurchaseController::class, 'ProductToPurchaseedit'])->name('dashboard.add-product-purchase.edit');

    Route::patch('{item}/update-purchase-items', [ProductPurchaseController::class, 'updateItemsPurchase'])->name('updateItemsPurchase');
    Route::get('{item}/delete-purchase-items', [ProductPurchaseController::class, 'deleteItemsPurchase'])->name('deleteItemsPurchase');

    // purchaseUpdate

?>