<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Review;
use App\Models\Wishlist;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(CartService $cartService ): void
     {
  

    View::composer('*', function ($view) use ($cartService) {
       // $data = cart();
       $userId = Auth::check() ? Auth::id() : null;
       $cartData = $userId ? $cartService->fetchCartData($userId) : [
        'count' => 0,
        'items' => [],
        'total' => 0.0,
    ];
    
       $userId = auth()->id();
      // $cartItems = getCartItems($userId);
        $general = GeneralSetting::first();
        $categories = ProductCategory::with('subcategories')->get();

        $wishlistCount = 0;

        if (Auth::check()) {
            $userId = Auth::id();
            $wishlistCount = Wishlist::where('user_id', $userId)->count();
        }

       
        
        $view->with([
            // 'composerCartList' => $cartItems,
            'composerGeneral' => $general,
            'categories' => $categories,
            'wishlistCount' => $wishlistCount,
            'cartCount' => $cartData['count'],
            'cartItems' => $cartData['items'],
            'cartTotal' => $cartData['total']

        ]);
        
    });
    }
     
}
