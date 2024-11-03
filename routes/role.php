<?php

use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Route;


    Route::get('/', [RolePermissionController::class, 'index'])->name('index');
    Route::get('create', [RolePermissionController::class, 'create'])->name('create');
    Route::post('/', [RolePermissionController::class, 'store'])->name('store');
    Route::get('{id}/edit', [RolePermissionController::class, 'edit'])->name('edit');
    Route::patch('{id}/update', [RolePermissionController::class, 'update'])->name('update');
    Route::delete('{id}', [RolePermissionController::class, 'destroy'])->name('destroy');
    Route::get('list', [RolePermissionController::class, 'list'])->name('list');
    Route::get('all', [RolePermissionController::class, 'allUsers'])->name('all');
    Route::get('profile-view', [RolePermissionController::class, 'profileView'])->name('profileView');


    Route::post('{id}/permission-update', [RolePermissionController::class, 'permissionUpdate'])->name('permissionUpdate');
    Route::post('{id}/permission-delete', [RolePermissionController::class, 'permissionDelete'])->name('permissionDelete');

    // store  
    Route::post('store', [RolePermissionController::class, 'store'])->name('store');


?>