<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use App\Services\CategoryService;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class FrontendCheckoutController extends BaseController
{
    protected $categoryService;
    protected $cartService;

    protected $couponService;

    public function __construct(CategoryService $categoryService, CartService $cartService, CouponService $couponService)
    {
        $this->categoryService = $categoryService;
        $this->cartService = $cartService;
        $this->couponService = $couponService;
        parent::__construct($categoryService);
    }


    public function view(Request $request)
    {

        // $this->couponService->clearCouponSession();

        $userId = auth()->id();
      $cartData = $this->cartService->fetchCartData($userId);
        $total = $cartData['total'];

        session()->put('finalTotal', $total);
       

        session()->put('cart', $cartData['items']);

        $finalTotal = Session::get('finalTotal', null);
        $discountAmount = Session::get('discountAmount');
        // Session::flush();

        $getCategoriesWithSubcategories = $this->categoryService->getCategoriesWithSubcategories();

        return view('web.frontend.pages.checkout', compact('getCategoriesWithSubcategories', 'cartData', 'finalTotal', 'total', 'discountAmount'));
    }

    public function checkout(Request $request)
    {
        $validatedData = $this->validateCheckoutRequest($request);


        $cartItems = Session::get('cart', collect())->toArray();
   

          $total=Session::get('finalTotal');
         
      
        

        // Create the order and order items
        $order = $this->createOrder($validatedData, $cartItems, $total);

       return back()->with('success', 'Order placed successfully!');
    }

    private function validateCheckoutRequest(Request $request)
    {
        return $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'at_phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'payment' => 'nullable|string|max:255',
        ]);
    }



    private function createOrder(array $validatedData, array $cartItems, $totalAmount)
    {
        return DB::transaction(function () use ($validatedData, $cartItems, $totalAmount) {
            $couponSession = $this->couponService->getCouponSession();
            $coupon = null;
            $coupon_discount = null;

            // If there's a coupon ID in the session, try to find the coupon
            if (!empty($couponSession['couponId'])) {
                $coupon = Coupon::find($couponSession['couponId']);
                $coupon_discount = $coupon ? $coupon->discount_amount : null;
            }

          


            // Create the order
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $validatedData['full_name'],
                'address' => $validatedData['address'],
                'phone_number' => $validatedData['phone'],
                'alternate_phone_number' => $validatedData['at_phone'],
                'payment_method' => "cash",
                'total_amount' => $couponSession['finalTotal'] ?? $totalAmount,
                'order_status' => 'pending',
                'invoice_number' => $this->generateInvoiceNumber(),
                'comment' => 'N/A',
            ]);
            // forget the $totalAmount
            Session::forget('finalTotal');
          

            $applicableProductIds = [];
            if ($coupon) {
                // Get IDs of products eligible for this coupon from the pivot table
                $applicableProductIds = DB::table('coupon_product')
                    ->where('coupon_id', $coupon->id)
                    ->pluck('product_id')
                    ->toArray();
            }

            foreach ($cartItems as $item) {
                Log::info('Processing item: ' . json_encode($item));
                $product = Product::find($item['id']);

                if ($product) {
                    $affRefercode =null;
                    $affCommissionDescription = json_encode([]);
                    $affCommission = 0.00;
                    $r = Session::get('affiliate_refer');
                    
                    if ($r) {
                        if ($r['product_id'] == $product->id) {
                            $commissionType = strtolower($product->commission_type);
                            $commissionAmount = $product->commission_amount;
                            $productPrice = $product->price;

                            if ($commissionType === 'fixed') {
                                $calculatedCommission = max(0, $commissionAmount);
                            } elseif ($commissionType === 'percent') {
                                if ($commissionAmount >= 0 && $commissionAmount <= 100) {
                                    $calculatedCommission = ($commissionAmount / 100) * $productPrice;
                                } else {
                                    $calculatedCommission = 0;
                                }
                            } else {
                                $calculatedCommission = 0;
                            }

                            $data = [
                                'Commission Type' => $commissionType,
                                'Commission Rate' => $product->commission_amount,
                                'Commission' => $calculatedCommission,
                            ];

                            // Set other relevant variables
                            $affRefercode = $r['referral_code'];
                            $affCommissionDescription = json_encode($data);
                            $affCommission = $calculatedCommission;

                            // Store in session if needed
                            Session::put('affiliate_refer', $data);
                        }
                    }

                    if ($product->quantity >= $item['quantity']) {
                        $campaignId = $item['campaign_id'] ?? null;

                        // Set coupon details if applicable
                        $couponCode = null;
                        $couponDiscount = null;
                        $couponDiscountType = null;

                        if ($coupon && in_array($product->id, $applicableProductIds)) {
                            $couponCode = $coupon->code;
                            $couponDiscount = $coupon->discount_amount;
                            $couponDiscountType = $coupon->discount_type;
                        }

                        // Create the order item
                        $orderItem=  OrderItem::create([
                            'order_id' => $order->id,
                            'campaign_id' => $campaignId,
                            'product_id' => $item['id'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                            'coupon_code' => $couponCode,
                            'coupon_discount' => $couponDiscount,
                            'coupon_discount_type' => $couponDiscountType,
                            'affiliate_refer_code' => $affRefercode,
                            'commission_description' => $affCommissionDescription,
                            'affiliate_commission' => $affCommission,

                        ]);

                        $attachData = []; 

                        if (isset($item['options'])) {
                            if (empty($item['options'])) {
                               // Log::info('No options found for item: ' . json_encode($item));
                            } else {
                               // Log::info('Options found: ' . json_encode($item['options']));

                                foreach ($item['options'] as $option) {
                                    Log::info('Processing option: ' . json_encode($option));
                                    if (isset($option['option_id']) ) {
                                        $attachData[] = [
                                            'option_id' => $option['option_id'],

                                        ];
                                    } else {
                                        Log::warning('Invalid option data: ' . json_encode($option));
                                    }
                                }
                            }
                        }

                        // attach the product 
                          if (!empty($attachData)) {
                            foreach ($attachData as $data) {
                                try {
                                    $orderItem->options()->attach($data);
                                } catch (\Exception $e) {
                                    Log::error('Error attaching option: ' . json_encode($data) . ' Error: ' . $e->getMessage());
                                }
                            }
                        }


                        $product->sold += $item['quantity'];
                        $product->quantity -= $item['quantity'];
                        $product->save();
                        Session::forget('affiliate_refer');
                      
                        CartItem::where('id', $item['cart_id'])->delete();
                    } else {
                        throw new \Exception('Insufficient stock for product ID: ' . $item['id']);
                    }
                }
            }

            $this->couponService->clearCouponSession();

            return $order;
        });
    }




    private function generateInvoiceNumber(): string
    {
        $datePart = date('Y-m-d'); // Format: YYYY-MM-DD


        $uniquePart = strtoupper(bin2hex(random_bytes(2)));

        return "INV-{$datePart}-{$uniquePart}";
    }

    // private function calculateCartTotal(array $cartItems): float
    // {
    //     return array_sum(array_map(function ($item) {
    //         return $item['price'] ;
    //     }, $cartItems));
    // }
}
