<?php 

  // accound controller

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

 
    Route::get('income', [AccountsController::class, 'income'])->name('income');
    Route::get('expense', [AccountsController::class, 'expense'])->name('expense');
    // Route::get('due', [AccountsController::class, 'due'])->name('due');
    Route::get('manage-balance', [AccountsController::class, 'manageBalance'])->name('manageBalance');
    Route::get('balance', [AccountsController::class, 'balance'])->name('balance');
    Route::get('fund-transfer', [AccountsController::class, 'fundTransfer'])->name('fundTransfer');
    Route::get('account-purpose', [AccountsController::class, 'accountPurpose'])->name('accountPurpose');
    Route::get('add-credit', [AccountsController::class, 'addCredit'])->name('addCredit');
    Route::get('debit', [AccountsController::class, 'debit'])->name('debit');
  
    Route::get('add-purpose', [AccountsController::class, 'addPurpose'])->name('addPurpose');
    Route::post('store-purpose', [AccountsController::class, 'storePurpose'])->name('storePurpose');
    Route::get('edit-purpose/{id}', [AccountsController::class, 'editPurpose'])->name('editPurpose');
  Route::patch('update-purpose/{id}', [AccountsController::class, 'updatePurpose'])->name('updatePurpose');
  Route::delete('delete-purpose/{id}', [AccountsController::class, 'deletePurpose'])->name('deletePurpose');

  Route::get('add-account-type', [AccountsController::class, 'addAccountType'])->name('addAccountType');
  Route::post('store-account-type', [AccountsController::class, 'storeAccountType'])->name('storeAccountType');
  Route::get('edit-account-type/{id}', [AccountsController::class, 'editAccountType'])->name('editAccountType');
  Route::patch('update-account-type/{id}', [AccountsController::class, 'updateAccountType'])->name('updateAccountType');
  Route::delete('delete-account-type/{id}', [AccountsController::class, 'deleteAccountType'])->name('deleteAccountType');

  
  // transaction controller
  Route::post('store-credit', [TransactionController::class, 'storeCredit'])->name('storeCredit');



?>