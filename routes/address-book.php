<?php

use App\Http\Controllers\AddressBookController;
use Illuminate\Support\Facades\Route;

Route::get('address-book', [AddressBookController::class, 'index'])->name('address-book');
Route::get('new-address', [AddressBookController::class, 'create'])->name('new-address');
Route::post('new-address', [AddressBookController::class, 'store'])->name('new-address.store');
Route::get('{id}/edit-address', [AddressBookController::class, 'edit'])->name('edit-address');
Route::patch('edit-address', [AddressBookController::class, 'updateAdd'])->name('edit-address.update');
Route::delete('{id}/delete-address', [AddressBookController::class, 'destroy'])->name('delete-address');
route::get('{id}/profile/edit',[AddressBookController::class,'profileEdit'])->name('profile.edit');
Route::get('/addresses/{id}', [AddressBookController::class, 'show'])->name('addresses.show');
Route::get('manage-address', [AddressBookController::class, 'manageAddress'])->name('manage-address');

Route::patch('personal-info', [AddressBookController::class, 'updatePersonalInfo'])->name('personal-info.update');
?>