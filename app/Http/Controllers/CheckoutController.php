<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\GeneralSetting;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Return_;

class CheckoutController extends Controller
{
    function findElementByKeyValue(array $data, string $searchKey, $searchValue): ?array
    {
        // Extract values for the search key
        $column = array_column($data, $searchKey);

        // Search for the value in the column
        $index = array_search($searchValue, $column);

        // Return the matched element or null if not found
        return $index !== false ? $data[$index] : null;
    }
    function productExists($collection, $id): bool
    {
        return $collection->contains('product_id', $id);
    }


    function invoice($id)
    {
       

        $orders = DB::table('orders')
    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
    ->leftJoin('order_item_options', 'order_items.id', '=', 'order_item_options.order_item_id')
    ->leftJoin('options', 'order_item_options.option_id', '=', 'options.id')
    ->leftJoin('attributes', 'options.attribute_id', '=', 'attributes.id')
    ->join('products', 'order_items.product_id', '=', 'products.id')
    ->where('orders.id', $id)
    ->select(
        'orders.id',
        'orders.user_id',
        'orders.customer_name',
        'orders.address',
        'orders.phone_number',
        'orders.note',
        'orders.payment_method',
        'orders.delivery',
        'orders.delivery_charge',
        'orders.order_status',
        'orders.steadfast_status',
        'orders.consignment_id',
        'orders.comment',
        'orders.invoice_number',
        'orders.created_at',
        'orders.updated_at',
        'order_items.product_id',
        'order_items.quantity',
        'order_items.price',
        'products.name as product_name', 
        'order_items.coupon_code',
        'order_items.coupon_discount',
        'order_items.coupon_discount_type',
        DB::raw('GROUP_CONCAT(
            CONCAT(
                attributes.name, ": ", options.name
            ) 
            ORDER BY attributes.name, options.name ASC SEPARATOR ", "
        ) as option_names')
    )
    ->groupBy(
        'orders.id',
        'orders.user_id',
        'orders.customer_name',
        'orders.address',
        'orders.phone_number',
        'orders.note',
        'orders.payment_method',
        'orders.delivery',
        'orders.delivery_charge',
        'orders.order_status',
        'orders.steadfast_status',
        'orders.consignment_id',
        'orders.comment',
        'orders.invoice_number',
        'orders.created_at',
        'orders.updated_at',
        'order_items.product_id',
        'order_items.quantity',
        'order_items.price',
        'products.name',
        'order_items.coupon_code',
        'order_items.coupon_discount',
        'order_items.coupon_discount_type'
    )
    ->get();




        $general = GeneralSetting::first();
        CartItem::where('cart_items.cart_id', request()->cookie('cart_id'))
            ->delete();

        // $pdf = Pdf::loadView('web.frontend.kama',  compact('general', 'orders'));
        // return $pdf->download('web.frontend.kama');
        return view('web.frontend.kama', compact('general', 'orders'));
    }


    

    public function store(Request $res)
    {

        // $p= $res->product;

        $products = $res->product;
        $quantities = $res->quantity;

        $combined = [];



        foreach ($products as $index => $productId) {

            $combined[] = [
                'product_id' => $productId,
                'quantity' => $quantities[$index]
            ];
        }



        // Checking if coupon code is available
        if (!empty($res->coupon_code)) {
            if (!$this->isCouponAvaiableForUse($res->coupon_code)) {
                toastr()->error('Coupon is invalid or expired.');
                return back();
            }
        }
        $order = null;
        DB::transaction(function () use ($res, $combined, &$order) {
            $general = GeneralSetting::first();

            // Creating order
            $order = Order::create([
                'user_id' => auth()->user()?->id,
                'customer_name' => $res->customer_name,
                'address' => $res->address,
                'phone_number' => $res->phone,
                'note' => $res->note,
                // 'area' => $res->area,
                'delivery' => ($res->delivery == 'inside-dhaka') ? 'inside' : 'outside',
                'delivery_charge' => ($res->delivery == 'inside-dhaka') ? $general->delivery_charge_inside_dhaka : $general->delivery_charge_outside_dhaka,
                'payment_method' => $res->payment_method,
                'invoice_number' => generateInvoiceId(),
            ]);
           
            // Handling coupon code
            if ($res->has('coupon_code')) {
                $coupon = Coupon::where('code', $res->coupon_code)->first();
                if ($coupon) {
                    $theseProductsHaveThisCouponCode = DB::table('coupon_product')
                        ->where('coupon_id', $coupon->id)
                        ->get();
                }
                foreach ($combined as $d) {
                    $isTheProductHasCuppon = $this->productExists($theseProductsHaveThisCouponCode, $d['product_id']);


                    $orderItem =  OrderItem::create([
                        'product_id' => $d['product_id'],
                        'quantity' => $d['quantity'],
                        'order_id' => $order->id,
                        'price' => price($d['product_id']),
                        'coupon_code' => $isTheProductHasCuppon ? $coupon->code : null,
                        'coupon_discount' => $isTheProductHasCuppon ? $coupon->discount_amount : null,
                        'coupon_discount_type' => $isTheProductHasCuppon ? $coupon->discount_type : null,

                    ]);

                    // update sold
                  return  $product = Product::find($d['product_id']);

                    if ($product) {

                        $product->sold += $d['quantity'];
                        $product->quantity -= $d['quantity'];
                        $product->save();
                    }

                    //   attach option id to order item

                    $optionIds = DB::table('cart_item_option')
                        ->join('cart_items', 'cart_items.id', '=', 'cart_item_option.cart_item_id')
                        ->where('cart_items.product_id', $d['product_id'])
                        ->pluck('cart_item_option.option_id');

                    $orderItem->options()->attach($optionIds);
                }
            } else {
                foreach ($combined as $d) {


                    $orderItem =  OrderItem::create([
                        'product_id' => $d['product_id'],
                        'quantity' => $d['quantity'],
                        'order_id' => $order->id,
                        'price' => price($d['product_id']),

                    ]);
                    // Decrement stock
                    $product = Product::find($d['product_id']);
                    if ($product) {
                        $product->sold += $d['quantity'];
                        $product->quantity -= $d['quantity'];
                        $product->save();
                    }

                    // Attach options to the order item
                    $optionIds = DB::table('cart_item_option')
                        ->join('cart_items', 'cart_items.id', '=', 'cart_item_option.cart_item_id')
                        ->where('cart_items.product_id', $d['product_id'])
                        ->pluck('cart_item_option.option_id');

                    $orderItem->options()->attach($optionIds);
                }
            }
        });
        return  $this->invoice($order->id);
    }




    function isCouponAvaiableForUse($couponCode)
    {

        $couponExists = Coupon::where('code', $couponCode)
            ->whereDate('expiry_date', '>=', now())
            ->exists();
        return $couponExists ? true : false;
    }
    function getProductsWithCoupon(array $productIds, int $couponId)
    {
        return DB::table('coupon_product')
            ->where('coupon_id', $couponId) 
            ->whereIn('product_id', $productIds) 
            ->pluck('product_id'); 
    }

    function checkout()
    {
      
        $pids = array_column(cart(), 'product_id');

     
        $isCartHasCoupon = DB::table('coupon_product')->whereIn('product_id', $pids)->exists();

        if (request()->has('coupon_code') && !request()->has('product')) {


            $couponExists = Coupon::where('code', request()->get('coupon_code'))->exists();
            if ($couponExists) {
                $coupon = Coupon::where('code', request()->get('coupon_code'))
                    ->whereDate('expiry_date', '>=', now())
                    ->first();
                if ($coupon) {
                  
                   $products = $this->getProductsWithCoupon($pids, $coupon->id)->implode(',');

                    return redirect()->route('checkout', [
                        'coupon_code' => request()->get('coupon_code'),
                        'product' => $products,
                        'type' => $coupon->discount_type == "percentage" ? 'P' : "F",
                        'coupon' => $coupon->discount_amount,

                    ]);
                } else {
                    toastr()->error('Coupon already expired.');
                }
            } else {
                toastr()->error('Invalid coupon code.');
            }
        }

        $delivery = GeneralSetting::first();
        return view('web.frontend.checkout', compact('delivery', 'isCartHasCoupon'));
    }
   

    public function addToCart(Request $request, $cart, $product_id)
{
    $quantity = $request->input('quantity');

     // Fetch the product to check available quantity
     $product = Product::find($product_id);
     if (!$product) {
         return response()->json(['error' => 'Product not found'], 404);
     }
 
     // Check if the requested quantity is valid
     if ($quantity > $product->quantity) {
        return response()->json([
            'error' => 'The quantity you requested exceeds the available stock. Please adjust your order to ' . $product->quantity . ' or fewer items.'
        ], 400);
     }

   
    $selectedOptions = $request->input('selectedOptions');
    $optionIds = [];

    if ($selectedOptions) {
        $decodedOptions = json_decode($selectedOptions, true);
       
        if (json_last_error() === JSON_ERROR_NONE) {
            $optionIds = array_values($decodedOptions);
        } else {

            return response()->json(['error' => 'Invalid selected options format'], 400);
        }
    }

 
    $existingCartItem = CartItem::where('cart_id', $cart)
                                ->where('product_id', $product_id)
                                ->first();

    if ($existingCartItem) {
      
        $existingCartItem->update([
            'quantity' => $existingCartItem->quantity + $quantity,
        ]);
    } else {
       
        $cartItem = CartItem::create([
            'product_id' => $product_id,
            'quantity' => $quantity,
            'cart_id' => $cart,
        ]);

       
        $cartItem->options()->attach($optionIds);
    }

   
    return CartItem::where('cart_id', $cart)
                   ->where('product_id', $product_id)
                   ->first();
}


public function removeFromCart($product_id)
{
    Log::info('Removing product from cart', ['product_id' => $product_id]);

    $user_id = auth()->id();

   
    // Retrieve the cart item
    $cartItem = CartItem::where('user_id', $user_id)
                        ->where('product_id', $product_id)
        ->first();

    Log::info('Retrieved cart item', ['cart_item' => $cartItem]);

    if (!$cartItem) {
        return response()->json(['status' => 'not_found', 'message' => 'Item not found'], 404);
    }

    // Delete the cart item
    $cartItem->delete();

    return response()->json(['status' => 'success', 'message' => 'Item removed'], 200);
}





   
    function countEle($cart)
    {
        $data = CartItem::where('cart_id', $cart)->count();
        return response($data);
    }
    function cartList()
    {




        return response(cart());
    }



    // now   
   

    public function clearData()
    {
        // Get the cart ID from the cookie
        $cartId = request()->cookie('cart_id');
        Log::info('Clearing cart data', ['cart_id' => $cartId]);
    
        try {
            if ($cartId) {
                // Delete cart items associated with the retrieved cart ID
                CartItem::where('cart_id', $cartId)->delete();
    
              
    
                return response()->json(['message' => 'Data cleared successfully!'], 200);
            } else {
                return response()->json(['message' => 'No cart ID found in the cookie.'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error clearing cart data', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred while clearing the data.'], 500);
        }
    }
    



    public function deleteFromCart($productId)
    {

        $item = CartItem::where('product_id', $productId)->first();



        if (!$item) {
            return response()->json(['status' => 'not_found', 'message' => 'Item not found'], 404);
        }

        // Log::info('Deleting cart item', ['product_id' => $productId, 'item' => $item]);

        $item->delete();

        return response()->json(['status' => 'success', 'message' => 'Item removed'], 200);
    }
}
