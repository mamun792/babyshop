<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    //
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutService
{
//     public function processCheckout($validatedData, $cartItems, $couponSession)
//     {
//         return DB::transaction(function () use ($validatedData, $cartItems, $couponSession) {
//             // Create the order
//             $order = Order::create([
//                 'user_id' => $validatedData['user_id'],
//                 'address' => $validatedData['address'],
//                 'payment_method' => $validatedData['payment_method'],
//                 'total_amount' => collect($cartItems)->sum('price'),
//                 'coupon_applied' => $couponSession ? $couponSession['code'] : null,
//             ]);

//             // Insert related items using Eloquent relationship
//             $orderItems = collect($cartItems)->map(fn($item) => [
//                 'product_id' => $item['product_id'],
//                 'quantity' => $item['quantity'],
//                 'price' => $item['price'],
//             ]);
//             $order->items()->createMany($orderItems->toArray());

//             // Clear cart
//             Session::forget('cart');

//             return $order;
//         });
//     }Refactored Approach with Service Class
// Step 1: Create a CheckoutService

// In the app/Services directory, create a CheckoutService.php file to handle the checkout logic.
// }Step 2: Modify Controller to Use CheckoutServiceuse Illuminate\Http\Request;
// use App\Services\CheckoutService;
// use Illuminate\Support\Facades\Log;

// public function checkout(Request $request, CheckoutService $checkoutService)
// {
//     // Validate request data
//     $validatedData = $request->validate([
//         'user_id' => 'required|integer',
//         'address' => 'required|string|max:255',
//         'payment_method' => 'required|string',
//         // Additional validations if needed
//     ]);

//     // Retrieve session data
//     $cartItems = Session::get('cart', []);
//     $couponSession = $this->couponService->getCouponSession();

//     Log::info('Processing checkout for user: ' . $validatedData['user_id']);

//     try {
//         // Process the checkout
//         $checkoutService->processCheckout($validatedData, $cartItems, $couponSession);

//         // Redirect on success
//         return redirect()->route('checkout.success')->with('message', 'Order placed successfully!');
        
//     } catch (\Exception $e) {
//         Log::error('Checkout Error: ' . $e->getMessage());
//         return back()->withErrors('An error occurred while processing your order. Please try again.');
//     }
// }
}
