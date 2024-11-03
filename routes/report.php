<?php


  // reports controller

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

  
    Route::get('profitLoss', [ReportController::class, 'profitLoss'])->name('profitLoss');
    //store 
    Route::post('profitLoss', [ReportController::class, 'profitLoss'])->name('profitLoss');

    //stock/report
    Route::get('stock', [ReportController::class, 'stock'])->name('stock');
    //store
    Route::post('stock', [ReportController::class, 'stock'])->name('stock');

    Route::get('order', [ReportController::class, 'order'])->name('order');
    Route::get('office/sale', [ReportController::class, 'officeSale'])->name('office.sale');
    Route::get('order/profit', [ReportController::class, 'orderProfit'])->name('order.profit');

    Route::get('sale/profit', [ReportController::class, 'saleProfit'])->name('sale.profit');
    // purchase
    Route::get('purchase', [ReportController::class, 'purchase'])->name('purchase');
    // supplier
    Route::get('supplier', [ReportController::class, 'supplier'])->name('supplier');
    // account
    Route::get('account', [ReportController::class, 'account'])->name('account');
    // product/stock
    Route::get('product/stock', [ReportController::class, 'productStock'])->name('product.stock');


    Route::post('/filter-orders', [ReportController::class, 'filterOrders'])->name('orders.filter');


?>