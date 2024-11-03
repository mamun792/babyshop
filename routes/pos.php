<?php

use App\Http\Controllers\PointOfSaleController;
use Illuminate\Support\Facades\Route;


    Route::get('/', [PointOfSaleController::class, 'index'])->name('index');
    Route::get('create', [PointOfSaleController::class, 'create'])->name('create');
    Route::get('{id}/edit', [PointOfSaleController::class, 'edit'])->name('edit');



?>