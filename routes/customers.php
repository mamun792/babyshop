<?php

use App\Http\Controllers\CustomersController;
use Illuminate\Support\Facades\Route;

    Route::get('/', [CustomersController::class, 'index'])->name('index');
  

?>