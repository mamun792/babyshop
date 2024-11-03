<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Services\CartService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class WishlistController extends BaseController
{
    protected $categoryService;
    protected $cartService;

    public function __construct(CategoryService $categoryService, CartService $cartService)
    {

        $this->categoryService = $categoryService;
        $this->cartService = $cartService;
        parent::__construct($categoryService);
    }

    public function index()
    {
        $userId = auth()->id();


        $wishlistsProducts = $this->getWishlistProducts($userId);

       $composerCartList=  $this->cartService->fetchCartData($userId);

        // $cartProducts = $this->getCartProducts();
        return view('web.dashboard.wishlist.index', compact('wishlistsProducts','composerCartList'));
    }



    public function addToWishlist($id)
    {
       // Log::info('Add to wishlist request', ['product_id' => $id]);
    
       
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated',
                'redirect' => route('login'), 
            ], 401);
        }
    
     
        if (!$this->isValidProductId($id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid product ID'
            ], 400);
        }
    
        $userId = Auth::id();
    
       
        if ($this->isProductInWishlist($userId, $id)) {
          
            Wishlist::where('user_id', $userId)
                ->where('product_id', $id)
                ->delete();
    
           
            $newCount = Wishlist::where('user_id', $userId)->count();
            Log::info( 'count product' , ['count' => $newCount ]);
    
            return response()->json([
                'success' => true,
                'added' => false,
                'message' => 'Product removed from wishlist.',
                'newCount' => $newCount 
            ]);
        }
    
       
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $id,
        ]);
    
     
        $newCount = Wishlist::where('user_id', $userId)->count();
      
    
        return response()->json([
            'success' => true,
            'added' => true,
            'message' => 'Product added to wishlist.',
            'newCount' => $newCount 
        ]);
    }
    

    private function isValidProductId($id)
    {
        return filter_var($id, FILTER_VALIDATE_INT) && Product::where('id', $id)->exists();
    }


    private function isProductInWishlist($userId, $productId)
    {
        return Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();
    }



    private function getWishlistProducts($userId)
    {
        return Wishlist::where('user_id', $userId)
            ->with('product') 
            ->get()
            ->pluck('product');
    }



    public function removeFromWishlist($id)
    {
       

        $id = (int) $id;

       
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated',
                'redirect' => route('login'),
            ], 401);
        }

       
        $userId = Auth::id();

       
        if (!$this->isProductInWishlist($userId, $id)) {
           
            return response()->json([
                'success' => false,
                'message' => 'Invalid product ID or product not in wishlist'
            ], 400);
        }

       
        Wishlist::where('user_id', $userId)
            ->where('product_id', $id)
            ->delete();

        
        return response()->json(['success' => true, 'message' => 'Product removed from wishlist.']);
    }

    public function favorit()
    {
        $userId = auth()->id();
       
       
       $favorites = Wishlist::with([
            'product:id,name,product_code,featured_image,price,discount_price',
            'product.productOptions:id,product_id,product_option_id',
            'product.productOptions.option:id,name,attribute_id',
            'product.productOptions.option.attribute:id,name',
        ])->where('user_id', $userId)->get();

        // Early return if there are no favorites
        if ($favorites->isEmpty()) {
            return view('web.frontend.pages.favorites', [
                'getCategoriesWithSubcategories' => $this->categoryService->getCategoriesWithSubcategories(),
                'favorites' => $favorites,
                'favoritesCount' => 0,
                'maxFavorites' => 150,
            ]);
        }

        // Group product options by attribute name
       $groupedAttributes = $favorites->flatMap(function ($favorite) {
            return $favorite->product->productOptions->groupBy(function ($option) {
                return strtolower($option->option->attribute->name);
            });
        })->filter(fn($options) => $options->isNotEmpty());

        // Get categories with subcategories
        $categoriesWithSubcategories = $this->categoryService->getCategoriesWithSubcategories();
        

        return view('web.frontend.pages.favorites', [
            'getCategoriesWithSubcategories' => $categoriesWithSubcategories,
            'favorites' => $favorites,
            'favoritesCount' => $favorites->count(),
            'maxFavorites' => 150,
        ]);
    }

   

}
