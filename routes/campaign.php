<?php

use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;

  
       Route::get('/', [CampaignController::class, 'index'])->name('index');
       //  Route::get('create', [CampaignController::class, 'create'])->name('create');
        Route::post('/', [CampaignController::class, 'store'])->name('store');
        Route::get('addCampaigns', [CampaignController::class, 'addCampaigns'])->name('addCampaigns');
        Route::post('addCampaigns', [CampaignController::class, 'storeCampaigns'])->name('storeCampaigns');
        Route::get('{id}/edit', [CampaignController::class, 'editproductcampain'])->name('edit.product.campaign');
        Route::patch('{id}/update', [CampaignController::class, 'update'])->name('update');

        
        Route::delete('{campaign}/delete', [CampaignController::class, 'destroy'])->name('destroy');
        Route::get('all', [CampaignController::class, 'allCampaigns'])->name('all');
        // product_campaign.store
        Route::post('/product', [CampaignController::class, 'storeProduct'])->name('product.store');
        // product code edit
        Route::get('{id}/product/code/edit', [CampaignController::class, 'productCodeEdit'])->name('product.code.edit');

        Route::patch('{id}/product/code/update', [CampaignController::class, 'productCodeUpdate'])->name('product.code.update');

        Route::delete('{id}',[CampaignController::class,'deleteProductCode'])->name('product.code.delete');
   

?>