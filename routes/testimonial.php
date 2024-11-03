<?php

use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

 
    Route::get('/', [TestimonialController::class, 'index'])->name('index');
    Route::get('create', [TestimonialController::class, 'create'])->name('create');
    Route::post('/', [TestimonialController::class, 'store'])->name('store');
    Route::get('{id}/edit', [TestimonialController::class, 'edit'])->name('edit');
    Route::patch('{id}/update', [TestimonialController::class, 'update'])->name('update');
    Route::delete('{id}', [TestimonialController::class, 'destroy'])->name('destroy');

?>