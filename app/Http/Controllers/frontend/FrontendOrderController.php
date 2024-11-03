<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\CartItemOption;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemOption;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FrontendOrderController extends Controller
{

    public function generateUniqueOrderId()
    {
        $orderId = mt_rand(1000000000, 9999999999); // 10-digit number

        // Ensure the generated ID is unique
        while (Order::where('id', $orderId)->exists()) {
            $orderId = mt_rand(1000000000, 9999999999);
        }

        return $orderId;
    }

    private function handlePaymentMethod($paymentMethod)
    {
        switch ($paymentMethod) {
            case 'cash':
                return 'Payment will be made upon delivery.';

            case 'bkash':
                return 'Bkash payment initiated.';

            case 'sslcommerz':
                return 'SSLCOMMERZ payment initiated.';

            default:
                throw new \Exception('Invalid payment method selected.');
        }
    }

    private function createOrder($request, $user, $delivery_charge)
    {
        return Order::create([
            'user_id' => $user->id,
            'customer_name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->mobile,
            'payment_method' => $request->payment_method,
            'delivery' => $request->delivery,
            'delivery_charge' => $delivery_charge,
            'order_status' => 'pending',
            'invoice_number' => $this->generateUniqueOrderId(),
        ]);
    }




    private function insertCouponOrderItems($coupon_data, $order_id, $coupon_code)
    {
        foreach ($coupon_data as $item) {

            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => ($item->price - $item->discount_price - $item->campaign_price),
                'coupon_code' => $coupon_code,
                'coupon_discount' => $item->discount_amount,
                'coupon_discount_type' => $item->discount_type,
            ]);
        }
    }

    private function insertNonCouponOrderItems($without_coupon_data, $order_id)
    {
        foreach ($without_coupon_data as $data) {
            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $data->id,
                'quantity' => $data->quantity,
                'price' => $data->price - $data->discount_price,
            ]);
        }
    }


    private function insertOrderItemOptions($order_item_id)
    {
        $cart_item_options = CartItemOption::all();

        foreach ($cart_item_options as $item) {
            OrderItemOption::create([
                'order_item_id' => $order_item_id,
                'option_id' => $item->option_id,
            ]);
        }
    }

    public function updateProductStockAndSales($cart_item_data)
    {
        foreach ($cart_item_data as $item) {
            // Find the product by product_id
            $product = Product::find($item['product_id']);

            // Check if the product exists
            if ($product) {
                // Reduce the product quantity by the quantity in the cart
                $product->quantity = $product->quantity - $item['quantity'];

                // Update the 'sold' field
                $product->sold = $product->sold + $item['quantity'];

                // Save the changes
                $product->save();
            }
        }
    }



    public function store(Request $request)
    {
       

        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
            'delivery' => 'required|in:inside,outside,offline',

        ]);


        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'Please login, you are not verified');
        }

        $paymentDetails = $this->handlePaymentMethod($request->payment_method);

        $generalSetting = GeneralSetting::find(1);
        $delivery_charge = $request->delivery === 'inside'
            ? $generalSetting->delivery_charge_inside_dhaka
            : $generalSetting->delivery_charge_outside_dhaka;

        // Create the order
        $order = $this->createOrder($request, $user, $delivery_charge);



        // Handle cart and coupon data
        $cartId = $request->cookie('cart_id') ?? uniqid('cart_', true);
        $coupon_code = session()->get('coupon_code');
        $coupon_data = session()->get('coupon_data');

        // Insert coupon-based order items

        if (!empty($coupon_data)) {
            $this->insertCouponOrderItems($coupon_data, $order->id, $coupon_code);
        }


        //$this->insertCouponOrderItems($coupon_data, $order->id, $coupon_code);


        // Insert non-coupon order items
        $product_ids_to_remove = collect($coupon_data)->pluck('id');
        $without_coupon_data = CartItem::where('cart_id', $cartId)
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->whereNotIn('product_id', $product_ids_to_remove)
            ->select('products.id', 'products.price', 'products.discount_price', 'cart_items.quantity')
            ->get();
        $this->insertNonCouponOrderItems($without_coupon_data, $order->id);


        // Insert order item options
        $order_item_id = OrderItem::latest('id')->value('id');
        $this->insertOrderItemOptions($order_item_id);


        // Fetch cart item data
        $cart_item_data = CartItem::where('cart_id', $cartId)
            ->with('products')
            ->get()
            ->map(function ($item) {
                return [
                    'product_id' => $item->product_id, // Cart item's product_id
                    'quantity' => $item->quantity,
                ];
            });

        // Now update the product stock and sold quantity
        $this->updateProductStockAndSales($cart_item_data);


        // Clear coupon data and cart
        Session::forget(['coupon', 'coupon_code', 'coupon_data']);
        CartItem::where('cart_id', $cartId)->delete();

        return redirect()->back()->with('success', 'Order successfully done');
    }
}
