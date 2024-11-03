<?php

use App\Http\Controllers\ProfileController;
use App\Models\Order;


use App\Http\Controllers\AboutController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController; // Assuming UserController handles privacy policy logic
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\AffiliateRegistrationController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\HeroSliderController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CartManagementController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\CustomUserRegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\frontend\AllProductController;
use App\Http\Controllers\frontend\AllProductsController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PointOfSaleController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductSubCategoryController;
use App\Http\Controllers\ProductChildCategoryController;
use App\Http\Controllers\ProductPurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TermsAndConditionController;
use App\Http\Controllers\ReturnPolicyController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StockOutProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckOutController as ControllersFrontendCheckOutController;
use App\Http\Controllers\frontend\FrontendCheckoutController;
use App\Http\Controllers\frontend\FrontendCouponController;
use App\Http\Controllers\frontend\FrontendOrderController;
use App\Models\CartManagement;
use App\Models\Policy;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
});


// routes/web.php or routes/api.php
Route::get('/auth/check', function () {
    return response()->json(['authenticated' => auth()->check()]);
});

// web.php
Route::get('dashboard/orders/comments', [CommentController::class, 'getComments'])->name('dashboard.orders.comments');


// ::::::::: API
Route::get('api/{cat_id}/subcategory-all', function ($cat_id) {
    $data = ProductSubCategory::where('category_id', $cat_id)->get();
    return response($data, 200);
})->name('api.subcategory');

Route::get('c', function () {
    $data = ProductSubCategory::where('category_id', 6)->get();
    return $data;
})->name('api.subcategory');



Route::get('affiliate-register-form', [AffiliateRegistrationController::class, 'index'])->name('affiliate.register.form');
Route::post('affiliate-register', [AffiliateRegistrationController::class, 'store'])->name('affiliate.register');


//Route::get('/', [FrontendController::class, 'home']);

//Frontend Route
Route::get('/', [HomeController::class, 'index']);
// Route::get('/product-details', [HomeController::class, 'productDetails']);
Route::get('/product-details/{slug}/{refer_code?}', [HomeController::class, 'productDetails'])->name('product-details');
Route::get('/all-product', [AllProductController::class, 'allProduct'])->name('allproduct');



// /////////////////////////////////
//Cart Route
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');  // fontend/ cartcontroller viewCart
Route::delete('{product_id}/remove-from-cart', [CartController::class, 'removeFromCart']); // fontend/ cartcontroller removeFromCart

Route::post('/save-for-later', [CartController::class, 'saveForLater'])->name('cart.saveForLater'); // fontend/ cartcontroller saveForLater

//Ajax call


Route::post('/cart/add', [CartController::class, 'addCart'])->name('cart.add')->middleware('auth'); // fontend/ cartcontroller addCart



//Checkout
Route::get('/product-checkout', [FrontendCheckoutController::class, 'view'])->name('productCheckout'); // fontend/ FrontendCheckoutController view

//Order
Route::post('/order-store', [FrontendOrderController::class, 'store'])->name('order.store'); // fontend/ FrontendOrderController store

//Coupon
Route::post('/apply-coupon', [FrontendCouponController::class, 'applyCoupon'])->name('apply.coupon'); // fontend/ FrontendCouponController applyCoupon

// checkout process 

Route::post('/checkout', [FrontendCheckoutController::class, 'checkout'])->name('checkout'); // fontend/ FrontendCheckoutController checkout
///////////////////////////












//
Route::get('/check-auth', function () {
    return response()->json(['authenticated' => auth()->check()]);
});


Route::get('/favorit', [WishlistController::class, 'favorit'])->name('wishlist.favorit');
Route::post('wishlist/add/{productId}', [WishlistController::class, 'addToWishlist'])
    ->name('wishlist.add');

Route::delete('wishlist/remove/{productId}', [WishlistController::class, 'removeFromWishlist'])
    ->name('wishlist.remove');




Route::post('{id}/apply-coupon', [ProductController::class, 'applyCoupon'])->name('applyCoupon');





Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard')->middleware('role:administrator');

Route::get('/get-order-statistics', [DashboardController::class, 'getOrderStatistics'])->middleware(['auth', 'verified'])->name('getOrderStatistics');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// 'role:administrator' middleware is used to restrict access to only users with the 'administrator' role
Route::middleware('auth','role:administrator')->prefix('dashboard')->as('dashboard.')->group(function () {
    Route::resource('about', AboutController::class);

    Route::resource('privacy-policy', UserController::class);
    Route::prefix('hero-section')->as('hero.')->group(function () {

        Route::get('/', [HeroSliderController::class,  'index'])->name('index');
        Route::post('/', [HeroSliderController::class,  'store'])->name('store');
        //  Route::post('/hero-slider', [HeroSliderController::class,  'storeHero'])->name('store.slider');

        Route::delete('{heroSlider}/destroy', [HeroSliderController::class, 'destroy'])->name('destroy');

        Route::get('show', [HeroSliderController::class, 'show'])->name('show');
    });

    Route::middleware('role:administrator')->group(function () {
        Route::get('/product/commission', [CommissionController::class, 'index'])->name('product.commission');
        Route::get('/affiliate/withdraw-requests', [CommissionController::class, 'withdrawRequest'])->name('affiliate.withdraw');
    });

    Route::prefix('attribute')->as('attribute.')->group(function () {
        Route::get('/', [AttributeController::class, 'index'])->name('index');
        Route::get('/create', [AttributeController::class, 'create'])->name('create');
        Route::post('/', [AttributeController::class, 'store'])->name('store');
        Route::get('{attribute}/show', [AttributeController::class, 'show'])->name('show');
        Route::get('{attribute}/edit', [AttributeController::class, 'edit'])->name('edit');
        Route::patch('{attribute}', [AttributeController::class, 'update'])->name('update'); // Alternative method for updating
        Route::delete('{attribute}/delete', [AttributeController::class, 'destroy'])->name('destroy');


        Route::prefix('option')->as('option.')->group(function () {
            Route::get('/', [AttributeController::class, 'optionAdd'])->name('add');
            Route::post('/{attribute}', [AttributeController::class, 'optionStore'])->name('store');
            Route::get('{option}/edit', [AttributeController::class, 'optionEdit'])->name('edit');
            Route::patch('{option}', [AttributeController::class, 'optionUpdate'])->name('update'); // Alternative method for updating
            Route::delete('{option}/delete', [AttributeController::class, 'optionDestroy'])->name('destroy');
        });
    });


    //  bBannerController
    Route::prefix('banner')->as('banner.')->group(function () {

        Route::post('/', [BannerController::class, 'store'])->name('store');
        Route::post('/slider', [BannerController::class, 'storeSlider'])->name('store.slider');
        Route::post('/slider', [BannerController::class, 'storeSliders'])->name('store.sliders');

        Route::delete('{id}', [BannerController::class, 'destroy'])->name('destroy');
        Route::delete('{id}/slider', [BannerController::class, 'DeleteSlider'])->name('slider.delete');
    });





    // added by prefix end
    Route::resource('categories', ProductCategoryController::class);
    Route::resource('subcategories', ProductSubCategoryController::class);
    Route::resource('social-media', SocialMediaController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('terms-and-conditions', TermsAndConditionController::class);
    Route::resource('return-policy', ReturnPolicyController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('contact', ContactController::class);
    // Route::resource('orders', OrderController::class);





    Route::resource('brand', BrandController::class);
    Route::resource('supplier', SupplierController::class)->except(['create', 'show']);
    Route::prefix('supplier')->as('supplier.')->group(function () {
        // Route::resource('/', SupplierController::class);
        Route::get('list', [SupplierController::class, 'list'])->name('list');
        Route::get('suppliers/trashed', [SupplierController::class, 'trashed'])->name('trashed');
        Route::post('suppliers/{id}/restore', [SupplierController::class, 'restore'])->name('restore');
        Route::delete('suppliers/{id}/force-delete', [SupplierController::class, 'forceDelete'])->name('forceDelete');
    });




    //  CustomersController

    //  ReviewController
    Route::middleware('role:customer|administrator')->prefix('review')->as('review.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::get('create', [ReviewController::class, 'create'])->name('create');
        Route::post('/', [ReviewController::class, 'store'])->name('store');
        Route::get('{id}/edit', [ReviewController::class, 'edit'])->name('edit');
        Route::patch('{id}', [ReviewController::class, 'update'])->name('update');
        Route::delete('{id}', [ReviewController::class, 'destroy'])->name('destroy');
    });

    // WishlistController
    Route::middleware('role:customer')->prefix('wishlist')->as('wishlist.')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('index');
        Route::get('create', [WishlistController::class, 'create'])->name('create');
        Route::post('/', [WishlistController::class, 'store'])->name('store');
        Route::get('{id}/edit', [WishlistController::class, 'edit'])->name('edit');
        Route::patch('{id}', [WishlistController::class, 'update'])->name('update');
        Route::delete('{id}', [WishlistController::class, 'destroy'])->name('destroy');
    });

    // pageController
    Route::middleware('role:administrator')->prefix('page')->as('pages.')->group(function () {
        Route::get('/policies', [PageController::class, 'index'])->name('policies');
        Route::Post('update', [PageController::class, 'update'])->name('policies.update');
        Route::get("/condition", [PageController::class, 'condition'])->name('condition');
        Route::Post("/condition/update", [PageController::class, 'conditionUpdate'])->name('condition.update');
        Route::get("/refund-policy", [PageController::class, 'refund'])->name('refund.policy');
        Route::Post("/refund-policy/update", [PageController::class, 'refundUpdate'])->name('refund.policy.update');
        Route::get("/sale-support", [PageController::class, 'saleSupport'])->name('sale.support');
        Route::Post("/sale-support/update", [PageController::class, 'saleSupportUpdate'])->name('sale.support.update');

        Route::get("/shipping-delivery", [PageController::class, 'shippingDelivery'])->name('shipping.delivery');
        Route::Post("/shipping-delivery/update", [PageController::class, 'shippingDeliveryUpdate'])->name('shipping.delivery.update');
    });



    // user dashboard
    Route::middleware('role:customer')->prefix('user')->group(function () {
        Route::get('/customer/dashboard', [UserController::class, 'index'])->name('user.customer.dashboard');
    });
    
    

    // WishlistController
    Route::prefix('wishlist')->as('wishlist.')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('index');
        Route::get('create', [WishlistController::class, 'create'])->name('create');
        Route::post('/', [WishlistController::class, 'store'])->name('store');
        Route::get('{id}/edit', [WishlistController::class, 'edit'])->name('edit');
        Route::patch('{id}', [WishlistController::class, 'update'])->name('update');
        Route::delete('{id}', [WishlistController::class, 'destroy'])->name('destroy');
    });
});

Route::get('/privacy-policy', function () {

    $policies = Policy::where('type', 'privacy-policy')->get();


    return view('web.frontend.C-pages.polices', compact('policies'));
})->name('polices');

Route::get('/terms-conditions', function () {
    $condition = Policy::where('type', 'terms-conditions')->get();
    return view('web.frontend.c-pages.conditions', compact('condition'));
})->name('conditions');

Route::get('/return-refund-policy', function () {
    $refund = Policy::where('type', 'return-refund-policy')->get();
    return view('web.frontend.c-pages.refund-policy', compact('refund'));
})->name('refund-policy');

Route::get('/sale-support', function () {
    $saleSupport = Policy::where('type', 'sale-support')->get();
    return view('web.frontend.c-pages.sale-support', compact('saleSupport'));
})->name('sale-support');

Route::get('/shipping-delivery', function () {
    $shoppings = Policy::where('type', 'shipping-delivery')->get();
    return view('web.frontend.c-pages.shipping-delivery', compact('shoppings'));
})->name('shipping-delivery');

Route::get(('search-product'), [FrontendController::class, 'searchProduct'])->name('search.product');
Route::get('/search-product-suggestions', [FrontendController::class, 'searchProductSuggestions'])->name('search.product.suggestions');



Route::post('/upload-media', [MediaController::class, 'uploadMedia'])->name('media.upload')->middleware('role:administrator');
Route::get('/about', [AboutController::class, 'index'])->name('about')->middleware('role:administrator');
Route::post('/about', [AboutController::class, 'store'])->name('about.store')->middleware('role:administrator');


//  CartManagementController

Route::middleware('auth','role:administrator')->prefix('dashboard')->as('dashboard.')->group(function () {
    Route::post('/adds-to-cart', [CartManagementController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart-itemss', [CartManagementController::class, 'getCartItems'])->name('cart.items');
    Route::delete('/{productId}/cart-itemss', [CartManagementController::class, 'destroy'])->name('cart.destroy');
    Route::get('search-user', [CartManagementController::class, 'searchUser'])->name('search.users');
    Route::get('search-user-defualt', [CartManagementController::class, 'searchUserDefualt'])->name('search.users.defualt');
    // Route to update cart quantity
    Route::put('/{productId}/cart-itemss', [CartManagementController::class, 'updateCartQuantity'])->name('cart.updateQuantity');
    // web.php



    Route::post('/reset-cart', [CartManagementController::class, 'resetCart'])->name('cart.reset');

    Route::post('/checkout', [CartManagementController::class, 'checkout'])->name('checkout');
    Route::get('/generate-invoice', [CartManagementController::class, 'generateInvoice']);
    Route::get('/download-invoice/{orderId}', [CartManagementController::class, 'downloadInvoice']);
});


Route::middleware('auth','role:administrator')->prefix('dashboard')->as('dashboard.')->group(function () {

    Route::get('/steadfast-courier', [ApiController::class, 'index'])->name('steadfast.courier');
    Route::post('/steadfast-courier', [ApiController::class, 'store'])->name('steadfast.courier.store');

    Route::get('/baksh', [ApiController::class, 'baksh'])->name('baksh');

    Route::get('/sscommerce', [ApiController::class, 'sscommerce'])->name('sscommerce');
    Route::get('/amerpay', [ApiController::class, 'amerpay'])->name('amerpay');
});



Route::post('/custom-register', [CustomUserRegisterController::class, 'customRegister'])->name('custom.register')->middleware('role:administrator');


// alfilne dashboard
Route::get('/allproducts', function () {

    $categoryService = app(CategoryService::class);

    $getCategoriesWithSubcategories = $categoryService->getCategoriesWithSubcategories();

    $products = Product::latest()->get();
    return view('web.dashboard.testing.allproducts', compact('products', 'getCategoriesWithSubcategories'));

})->name('a.allproducts');

Route::get('/all-products', [AllProductsController::class, 'index'])->name('all.products');

// affiliate dashboard

Route::middleware('auth','role:affiliate')->prefix('dashboard')->as('dashboard.')->group(function () {

    Route::get('/affiliate', [AffiliateController::class, 'index'])->name('affiliate.dashboard');
    Route::get('/affiliate/products', [AffiliateController::class, 'products'])->name('affiliate.products');
    // reports
    Route::get('/affiliate/reports', [AffiliateController::class, 'reports'])->name('affiliate.reports');
    // settings
    Route::get('/affiliate/settings', [AffiliateController::class, 'settings'])->name('affiliate.settings');
    Route::post('/affiliate/basic/info', [AffiliateController::class, 'basicUpdate'])->name('affiliate.basic.update');
    Route::post('/affiliate/password', [AffiliateController::class, 'passwordUpdate'])->name('affiliate.password.update');
    Route::post('/affiliate/paymentUpdate', [AffiliateController::class, 'paymentUpdate'])->name('affiliate.paymentMethod.update');
    // payment
    Route::get('/affiliate/earning', [AffiliateController::class, 'earning'])->name('affiliate.earning');
    Route::get('/affiliate/payment', [AffiliateController::class, 'payment'])->name('affiliate.payment');
    Route::post('/affiliate/payment/request', [AffiliateController::class, 'paymentRequest'])->name('affiliate.payment.request');
});



require __DIR__ . '/auth.php';
