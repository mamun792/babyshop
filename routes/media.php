<?php

use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;


    Route::get('/', [MediaController::class, 'index'])->name('media.index');
    Route::get('create', [MediaController::class, 'create'])->name('media.create');
    Route::post("/", [MediaController::class, 'store'])->name('media.store');
    Route::get('{id}/edit', [MediaController::class, 'edit'])->name('media.edit');
    Route::patch('{id}/update', [MediaController::class, 'update'])->name('media.update');
    Route::delete('{id}', [MediaController::class, 'destroy'])->name('media.destroy');


?>