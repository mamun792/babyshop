<?php

use App\Http\Controllers\GeneralSettingController;
use Illuminate\Support\Facades\Route;


    Route::get('/', [GeneralSettingController::class, 'index'])->name('general-settings.index');
    Route::get('create', [GeneralSettingController::class, 'create'])->name('general-settings.create');
    Route::post("update", [GeneralSettingController::class, 'update'])->name('update');

?>