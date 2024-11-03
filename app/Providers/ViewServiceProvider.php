<?php

namespace App\Providers;

use App\Models\Wishlist;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $wishlistProducts = Wishlist::where('user_id', auth()->id())->pluck('product_id')->toArray();
                $view->with('wishlistProducts', $wishlistProducts);
            } else {
                $view->with('wishlistProducts', []);
            }
        });
    }

    
}

