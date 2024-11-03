<?php

use App\Http\Controllers\StockController;
use App\Http\Controllers\StockOutProductController;
use Illuminate\Support\Facades\Route;

    
        Route::get('index', [StockController::class, 'index'])->name('index');
        Route::get('stock-out', [StockController::class, 'stock_out'])->name('out');

        Route::get('upcoming', [StockController::class, 'upcoming'])->name('upcoming');
  
?>