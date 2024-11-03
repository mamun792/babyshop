<?php

namespace App\Http\Controllers\frontend;

use App\Events\CartUpdated;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CartItem;
use App\Models\CartItemOption;
use App\Models\ProductOption;
use App\Services\CartService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class CartController extends BaseController
{

    protected $categoryService;

    protected $cartService;

    public function __construct(CategoryService $categoryService, CartService $cartService)
    {
        $this->categoryService = $categoryService;
        $this->cartService = $cartService;
        parent::__construct($categoryService);
    }



    public function addCart(Request $request)
    {
        try {
            $data = $request->all();
            $cartItem = $this->cartService->addCartItem($data, auth()->id());
            $cartData = $this->cartService->fetchCartData(auth()->id());


            return response()->json(
                [
                    'message' => 'Product added to cart',
                    'cart' => $cartData,

                    'success' => true,
                ],

                200
            );
        } catch (\Exception $error) {
            Log::error('Error adding product to cart: ' . $error->getMessage(), [
                'data' => $data,
                'user_id' => auth()->id(),
                'stack_trace' => $error->getTraceAsString(),
            ]);
        }
    }

    public function viewCart(Request $request)
    {

        $getCategoriesWithSubcategories = $this->categoryService->getCategoriesWithSubcategories();

        // return Campaign::all();

        $userId = auth()->id();
        $cartSummary = $this->cartService->fetchCartData($userId);

        $count = count($cartSummary['items']);


        return view('web.frontend.pages.cart', [
            'getCategoriesWithSubcategories' => $getCategoriesWithSubcategories,
            'cartSummary' => $cartSummary,
            'count' => $count,
            'total' => $cartSummary['total'],

        ]);
    }



    public function removeFromCart($product_id)
    {
        Log::info('Removing product from cart', ['product_id' => $product_id]);

        $user_id = auth()->id();


        // Retrieve the cart item
        $cartItem = CartItem::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

      

        if (!$cartItem) {
            return response()->json(['status' => 'not_found', 'message' => 'Item not found'], 404);
        }

       
        $cartItem->delete();

        return response()->json(['status' => 'success', 'message' => 'Item removed'], 200);
    }






    public function saveForLater(Request $request)
    {
        try {
            $cart = $this->cartService->updateCartItem($request->all(), auth()->id());
            return response()->json(['status' => 'success', 'message' => 'Cart updated successfully', 'data' => $cart], 200);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'Product or cart item not found'], 404);
        } catch (\Exception $e) {
            Log::error('Save For Later Error', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }





   
}
