<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\CouponProduct;
use App\Models\OrderItem;
use App\Services\CouponService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendCouponController extends Controller
{
    //

    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'couponCode' => 'required|string|max:255',
        ]);

        $response = $this->couponService->applyCoupon($request->couponCode);
        return response()->json($response);
       
    }
}
