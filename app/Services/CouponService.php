<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\CouponProduct;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CouponService
{
    public function applyCoupon($couponCode)
    {
        // flush the session


        try {
            // Retrieve the coupon object based on the coupon code
            $coupon = $this->getCoupon($couponCode);
            if (!$coupon) {
                return $this->response(false, 'Invalid coupon code.');
            }

            $couponProducts = CouponProduct::where('coupon_id', $coupon->id)->get();

            // Ensure there are applicable products
            if ($couponProducts->isEmpty()) {
                return $this->response(false, 'This coupon is not applicable to any product.');
            }
            // loop through the coupon product
            // foreach ($couponProducts as $product) {
            //     Log::info('coupon product id: ' . $product->product_id);
            // }

    
            // Ensure the coupon is prensent in the database coupon_product pivot table
            if (!CouponProduct::where('coupon_id', $coupon->id)->exists()) {
                return $this->response(false, 'Coupon is not applicable to any products.');
            }

            // Ensure the coupon is an object and not wrapped incorrectly
            if (!is_object($coupon)) {
                return $this->response(false, 'Error retrieving coupon.');
            }

            // Validate the coupon
            if (!$this->isCouponValid($coupon)) {
                return $this->response(false, 'Coupon is not valid.');
            }

            if (!$this->isUsageLimitValid($coupon)) {
                return $this->response(false, 'Coupon usage limit has been reached.');
            }

            // Calculate the total discount based on the coupon and cart items
            $discountedTotal = $this->calculateDiscounts($coupon);
            $finalTotal = $discountedTotal['final_total_price'];


            // Set session values
            // Session::put('couponCode', $coupon->code);
            // Session::put('discountAmount', $discountedTotal['total_discount']);
            // Session::put('discountType', $coupon->discount_type);
            Session::put('finalTotal', $finalTotal);
            Session::put('couponId', $coupon->id);





            // Return the response with discount details
            return $this->response(true, '', number_format($discountedTotal['total_discount'], 2), number_format($finalTotal, 2));
        } catch (\Exception $e) {
            Log::error('Coupon application error: ' . $e->getMessage());
            return $this->response(false, 'An error occurred while applying the coupon.');
        }
    }

    private function getCoupon($couponCode)
    {
        // Fetch the coupon from the database
        return Coupon::where('code', $couponCode)->first();
    }

    private function isCouponValid($coupon)
    {
        // Check if the coupon is within its valid date range
        $currentDate = Carbon::now();
        return $currentDate->gte($coupon->valid_from) && $currentDate->lte($coupon->expiry_date);
    }

    private function isUsageLimitValid($coupon)
    {

        if ($coupon->usage_limit > 0) {

            // check  cupon id wise drecment 
            $couponUsed = Coupon::where('id', $coupon->id)->first();
            $couponUsed->usage_limit = $couponUsed->decrement('usage_limit');
            $couponUsed->save();
            return true;
        }

        return false;
    }



    private function calculateDiscounts($coupon)
    {
        $cartItems = Session::get('cart', []);
        $totalBeforeDiscount = 0;
        $totalDiscount = 0;
        $totalCampaignDiscount = 0;

        foreach ($cartItems as $item) {
            // Calculate total price before discounts
            $itemTotalPrice = (float)$item['product_price'] * (int)$item['quantity'];
            $totalBeforeDiscount += $itemTotalPrice;

            // Check if the coupon is applicable to the product
            if ($this->isCouponApplicableToProduct($coupon->id, $item['id'])) {
                // Calculate discount per unit based on the coupon
                $discountPerUnit = $this->calculateDiscountPerUnit($coupon, (float)$item['product_price']);
                // Calculate total discount for this item
                $totalItemDiscount = $discountPerUnit * $item['quantity'];
                $totalDiscount += $totalItemDiscount;

                // Calculate the campaign discount for the item
                $campaignDiscount = (float)$item['discount'] * (int)$item['quantity']; // Assuming campaign_discount is stored in the item
                $totalCampaignDiscount += $campaignDiscount;

                // Log individual item calculations
                Log::info("Item: {$item['name']}, Total Price: $itemTotalPrice, Unit Discount: $discountPerUnit, Total Discount: $totalItemDiscount, Campaign Discount: $campaignDiscount");
            }
        }

        // Calculate final totals
        $totalAfterCouponDiscount = $totalBeforeDiscount - $totalDiscount;
        $finalTotalPrice = $totalAfterCouponDiscount - $totalCampaignDiscount;



        // Log::info('Total before discount: ' . $totalBeforeDiscount);
        // Log::info('Total discount: ' . $totalDiscount);
        // Log::info('Total campaign discount: ' . $totalCampaignDiscount);
        // Log::info('Final total price: ' . $finalTotalPrice);

        return [
            'total_before_discount' => $totalBeforeDiscount,
            'total_discount' => $totalDiscount,
            'total_campaign_discount' => $totalCampaignDiscount,
            'final_total_price' => $finalTotalPrice,
        ];
    }



    private function calculateDiscountPerUnit($coupon, $unitPrice)
    {
        if (!isset($coupon->discount_type) || !isset($coupon->discount_amount)) {
            Log::warning('Coupon missing discount_type or discount_amount.');
            return 0; // Default to 0 if coupon is invalid
        }

        // Calculate the discount amount based on the coupon type
        if ($coupon->discount_type === 'percentage') {
            return $unitPrice * ($coupon->discount_amount / 100);
        }

        // If it's a fixed discount, apply it up to the unit price
        return min($coupon->discount_amount, $unitPrice);
    }




    private function isCouponApplicableToProduct($couponId, $productId)
    {
        // Check if the coupon can be applied to the specified product
        return CouponProduct::where('coupon_id', $couponId)->where('product_id', $productId)->exists();
    }







    private function response($success, $message, $discount = '0.00', $finalTotal = '0.00')
    {
        // Format and return the response
        return [
            'success' => $success,
            'message' => $message,
            'discount' => $discount,
            'finalTotal' => $finalTotal,

        ];
    }

    // Method to get the coupon session details
    public function getCouponSession()
    {
        return [
            // 'couponCode' => Session::get('couponCode'),
            // 'discountAmount' => Session::get('discountAmount'),
            // 'discountType' => Session::get('discountType'),
            'finalTotal' => Session::get('finalTotal'),
            'couponId' => Session::get('couponId'),
        ];
    }

    // Method to clear the coupon session details
    public function clearCouponSession()
    {
        Session::forget('couponCode');
        Session::forget('discountAmount');
        Session::forget('discountType');
        Session::forget('finalTotal');
    }
}
