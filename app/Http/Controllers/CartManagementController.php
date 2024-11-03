<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartManagementRequest;
use App\Models\CartItem;
use App\Models\CartManagement;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CartManagementController extends Controller
{


    public function addToCart(CartManagementRequest $request)
    {
        $validated = $request->validated();

        $productId = $validated['productId'];
        $quantity = $validated['quantity'];
        $userId = $validated['userId'];

      
        $product = $this->findProduct($productId);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        
        if (!$this->isProductInStock($product)) {
            return response()->json(['error' => 'Product is out of stock'.'max quantity is '.$product->quantity

        ], 400);
        }

       
        $price = $this->getProductPrice($product);

     
        $this->updateOrCreateCartItem($userId, $productId, $quantity, $price);

        return response()->json(['success' => true, 'message' => 'Item added to cart']);
    }

    private function findProduct($productId)
    {
        return Product::find($productId);
    }

    private function isProductInStock($product)
    {
        return $product->quantity > 0;
    }

    private function getProductPrice($product)
    {
        return $product->discount_price ?? $product->regular_price;
    }

    private function updateOrCreateCartItem($userId, $productId, $quantity, $price)
    {
        $cartItem = CartManagement::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartManagement::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
                'created_at' => now(),
            ]);
        }
    }



    public function getCartItems(Request $request)
    {


        $userId = $request->input('user_id');

        if (!$userId || !is_numeric($userId)) {
            return response()->json(['error' => 'Invalid user ID'], 400);
        }

        $cartItems = CartManagement::with('product')
            ->leftJoin('products', 'cart_management.product_id', '=', 'products.id')
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select(
                'cart_management.*',
                'products.name as product_name',
                'products.discount_price',
                'product_categories.name as category_name'
            )
            ->where('cart_management.user_id', $userId)
            ->get();

        return response()->json($cartItems);
    }



    public function destroy(Request $request, $id)
    {
        $userId = $request->input('user_id');


        $cartItem = CartManagement::where('user_id', $userId)
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->delete();

            return response()->json(['message' => 'Item deleted successfully'], 200);
        } else {

            return response()->json(['message' => 'Item not found'], 404);
        }
    }

    public function searchUser(Request $request)
    {
        $query = $request->input('query');


        $users = User::where('email', 'like', '%' . $query . '%')
            ->orWhere('phone', 'like', '%' . $query . '%')
            ->get(['id', 'name', 'email', 'phone']);

       
        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found'], 404);
        }

       
        return response()->json($users);
    }

    public function updateCartQuantity(Request $request, $productId)
    {


        $userId = $request->input('user_id');
        $quantity = $request->input('quantity');

       
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

       
        if ($quantity < 1) {
            return response()->json(['error' => 'Quantity must be at least 1'], 400);
        }

        if ($quantity > $product->quantity) {
            return response()->json(['error' => 'Quantity are not  available stock'], 400);
        }

        $cartItem = CartManagement::where('user_id', $userId)->where('product_id', $productId)->first();


        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
            return response()->json(['success' => true]);
        }



        return response()->json(['error' => 'Cart item not found'], 404);
    }


    public function checkout(Request $request)
    {

        $userId = $request->input('userId');
        $discountType = $request->input('discountType');
        $discountAmount = $request->input('discountAmount');
        $shippingCost = $request->input('shippingCost');


        $cartItems = CartManagement::where('user_id', $userId)->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty.'], 400);
        }

        Log::info($cartItems);

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $totalPrice = $this->calculateTotalPrice($cartItems, $discountType, $discountAmount, $shippingCost);
        $order = $this->createOrder($user, $totalPrice, $shippingCost, $discountAmount);




        
        $order_id = $order->id;

        foreach ($cartItems as $cartItem) {

            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'coupon_code' =>  null,
                'coupon_discount' =>    0,
                'coupon_discount_type' => null,
                'price' => $cartItem->product->price,
                'is_type' => 'pos',
                'created_at' => now(),
            ]);
        }

   

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $product->sold += $cartItem->quantity;
            $product->quantity -= $cartItem->quantity;
            $product->save();
        }


        session([
            'price' => [
                'totalPrice' => $totalPrice,
                'orderId' => $order->id,
                'discountAmount' => $discountAmount,
                'shippingCost' => $shippingCost
            ]
        ]);

        return response()->json([


            'success' => true,
        ]);
    }

    private function calculateTotalPrice($cartItems, $discountType, $discountAmount, $shippingCost)
    {
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        
        if ($discountType === 'percentage') {
            $totalPrice -= ($totalPrice * $discountAmount / 100);
        } elseif ($discountType === 'fixed') {
            $totalPrice -= $discountAmount;
        }

       
        $totalPrice += $shippingCost;

        return $totalPrice;
    }

    private function createOrder($user, $totalPrice, $shippingCost, $discountAmount)
    {


        $prefix = 'INV-';
        $randomString = generateInvoiceId();
        $invoiceNumber = $prefix . $randomString;


        if ($shippingCost == 60) {
            $deliveryType = 'inside';
        } elseif ($shippingCost == 120) {
            $deliveryType = 'outside';
        } else {
            $deliveryType = 'offline';
        }

        return Order::create([
            'user_id' => $user->id,
            'customer_name' => $user->name,
            'address' => $user->street_address,
            'phone_number' => $user->phone,
           'total_amount'=> $totalPrice,
            'payment_method' => 'cash',
            // 'delivery' => $deliveryType,
            // 'delivery_charge' => $shippingCost,
            'order_status' => 'Pending',
            'invoice_number' => $invoiceNumber,
            'created_at' => now(),
        ]);
    }


    public function resetCart(Request $request)
    {
        $userId = $request->input('userId');

        if (!$userId) {
            return response()->json(['error' => 'User ID not provided.'], 400);
        }

        CartManagement::where('user_id', $userId)->delete();

        return response()->json(['success' => true]);
    }

    public function generateInvoice()
    {

        $data = session('price', []);
        $orderId = $data['orderId'] ?? null;
        $shippingCost = $data['shippingCost'] ?? null;
        // $discountAmount = $data['discountAmount'] ?? null;



        if (!$orderId) {
            return redirect('/dashboard')->withErrors('Order ID not provided.');
        }


        $orderDetails = DB::table('orders')->where('id', $orderId)->first();
        if (!$orderDetails) {
            return redirect('/dashboard')->withErrors('Order not found.');
        }


        $cartItems = CartManagement::where('user_id', $orderDetails->user_id)->get();


        $productIds = $cartItems->pluck('product_id');
        $products = DB::table('products')
            ->whereIn('id', $productIds)
            ->get()
            ->map(function ($product) use ($cartItems) {
                $item = $cartItems->where('product_id', $product->id)->first();
                $product->quantity = $item ? $item->quantity : 0;
                return $product;
            });

            $discountAmount = $data['discountAmount'] * $products->sum('quantity') ?? 0;
            Log::info($discountAmount);

        $user = User::find($orderDetails->user_id);
        $totalPrice = $products->sum(function ($product) {
            return $product->discount_price * $product->quantity;
        });

        $finalPrice = $totalPrice - ($discountAmount ?? 0) + $shippingCost;


        $orderDetails->created_at = \Carbon\Carbon::parse($orderDetails->created_at);

        CartManagement::where('user_id', $orderDetails->user_id)->delete();

        session()->forget('price');


        return view('pdf.invoice', compact('orderDetails', 'products', 'totalPrice', 'user', 'discountAmount', 'finalPrice', 'shippingCost'));
    }



    public function searchUserDefualt(Request $request)
    {
        Log::info($request);
        $query = $request->input('query');
        Log::info($query);


        $users = User::where('email', 'like', '%' . $query . '%')
            ->orWhere('phone', 'like', '%' . $query . '%')
            ->orWhere('id', $query)
            ->get(['id', 'name', 'email', 'phone']);

        Log::info($users);


        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found'], 404);
        }


        return response()->json($users);
    }
}
