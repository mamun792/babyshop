
<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;



Route::get('/', [CommentController::class, 'index'])->name('index'); 
Route::get('/create', [CommentController::class, 'create'])->name('create');
Route::put('/{id}/update', [CommentController::class, 'update'])->name('update');
Route::delete('/{id}/delete', [CommentController::class, 'delete'])->name('delete');
Route::post('/', [CommentController::class, 'store'])->name('store');
Route::get('/{id}', [CommentController::class, 'showComment'])->name('show');
Route::get('/{id}/edit', [CommentController::class, 'edit'])->name('edit');

Route::post('/{id}/toggle-status', [CommentController::class, 'toggleStatus'])->name('comments.toggleStatus');







