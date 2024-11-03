<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PointOfSaleController;
use App\Http\Controllers\SteadfastController;
use Illuminate\Support\Facades\Route;

// Route::prefix('orders')->as('orders.')->group(function () {
Route::get('/', [OrderController::class, 'index'])->name('index');
Route::get('create', [OrderController::class, 'create'])->name('create');
Route::post('/', [OrderController::class, 'store'])->name('store');
Route::get('{id}/edit', [OrderController::class, 'edit'])->name('edit');
Route::patch('{id}/update', [OrderController::class, 'update'])->name('update');
Route::delete('{id}', [OrderController::class, 'delete'])->name('destroy');

Route::prefix('offline')->as('offline.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
});
Route::get('return', [OrderController::class, 'returnOder'])->name('return');
Route::get('select', [OrderController::class, 'selectOrder'])->name('select');
Route::get('cancel', [OrderController::class, 'cancelOrder'])->name('cancel');

// Route::
// web.php
Route::post('/comment/update/{id}', [OrderController::class, 'updateComment'])->name('comment.update');



Route::post('/bulk-delete', [OrderController::class, 'bulkDelete'])->name('bulk.delete');
Route::post('/bulk-update-status', [OrderController::class, 'bulkUpdateStatus'])->name('bulk.update.status');

// invoice view
Route::get('{order}/invoice', [OrderController::class, 'invoice'])->name('invoice');


// Order Management Filter Routes


Route::get('filter', [OrderController::class, 'filter'])->name('filter');



Route::get('{status}/{order}/steadfast-create',[SteadfastController::class, 'createDelivery'])->name('createDelivery');


