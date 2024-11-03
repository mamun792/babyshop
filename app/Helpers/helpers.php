<?php

use App\Models\CartItem;
use App\Models\MediaFile;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;


if (!function_exists('authUserRoles')) {
    function authUserRoles()
    {

        return auth()->user()->roles->pluck('name')[0];
    }
}

if (!function_exists('slug_generator')) {
    function slug_generator($data)
    {

        return strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $data)));
    }
}

if (!function_exists('formatColorName')) {
    function formatColorName($input)
    {
        // Use regex to check and capture the color name part
        if (preg_match('/^([A-Za-z]+) \| #\w{6}$/', $input, $matches)) {
            // Format the color name by adding spaces before uppercase letters and capitalize each word
            return ucwords(preg_replace('/(?<!^)([A-Z])/', ' $1', $matches[1]));
        }

        // Return the input unchanged if it doesn't match the pattern
        return $input;
    }
}






if (!function_exists('getTotalPendingOrdersByMonth')) {
    function getTotalPendingOrdersByMonth()
    {
        $today = Carbon::now();
        $startOfCurrentMonth = $today->startOfMonth();
        $startOfPreviousMonth = $startOfCurrentMonth->copy()->subMonth()->startOfMonth();
        $endOfPreviousMonth = $startOfPreviousMonth->copy()->endOfMonth(); // End of the previous month

        // Query once for the total count of orders by their status
        $orders = Order::select('order_status', DB::raw('COUNT(*) as total'))
            ->whereIn('order_status', ['pending', 'delivered', 'returned'])
            ->groupBy('order_status')
            ->get()
            ->keyBy('order_status');

        // Query once for the previous month's orders by status
        $previousMonthOrders = Order::select('order_status', DB::raw('COUNT(*) as total'))
            ->whereIn('order_status', ['pending', 'delivered', 'returned'])
            ->whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])
            ->groupBy('order_status')
            ->get()
            ->keyBy('order_status');

        // Return data or set default value if no orders were found
        return [
            'totalPendingOrder' => $orders->get('pending')->total ?? 0,
            'totalPendingOrdersPreviousMonth' => $previousMonthOrders->get('pending')->total ?? 0,
            'deliveredOrders' => $orders->get('delivered')->total ?? 0,
            'totalOrdersDeliverePreviousMonth' => $previousMonthOrders->get('delivered')->total ?? 0,
            'returnedOrders' => $orders->get('returned')->total ?? 0,
            'totalOrdersReturnedPreviousMonth' => $previousMonthOrders->get('returned')->total ?? 0,
        ];
    }
}



if (!function_exists('getOrderStatistics')) {
    function getOrderStatistics()
    {
        // Helper function to calculate total sales amounts based on status and type
        $calculateTotalAmount = function ($status, $isType = null) {
            $query = DB::table('order_items')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.order_status', $status);

            if ($isType) {
                $query->where('order_items.is_type', $isType);
            }

            // Calculate the total price (including discounts)
            $totalAmount = $query->selectRaw('SUM(
                CASE
                    WHEN order_items.is_type = "pos" THEN (order_items.price * order_items.quantity)
                    ELSE
                        (order_items.price -
                        (CASE
                            WHEN order_items.coupon_discount_type = "percentage" AND order_items.coupon_discount IS NOT NULL
                            THEN (order_items.price * (order_items.coupon_discount / 100))
                            ELSE IFNULL(order_items.coupon_discount, 0)
                        END)) * order_items.quantity
                END
            ) AS total_amount')
                ->value('total_amount');

            return $totalAmount ?? 0;
        };

        // Calculate total sales for different statuses
        $totalCancel = $calculateTotalAmount('cancelled');
        $totalDelivered = $calculateTotalAmount('delivered');
        $totalReturned = $calculateTotalAmount('returned');

        // Calculate overall sales (ignoring status)
        $totalSales = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.order_status', 'delivered') // Assuming you want total sales for delivered orders
            ->selectRaw('SUM(
                CASE
                    WHEN order_items.is_type = "pos" THEN (order_items.price * order_items.quantity)
                    ELSE
                        (order_items.price -
                        (CASE
                            WHEN order_items.coupon_discount_type = "percentage" AND order_items.coupon_discount IS NOT NULL
                            THEN (order_items.price * (order_items.coupon_discount / 100))
                            ELSE IFNULL(order_items.coupon_discount, 0)
                        END)) * order_items.quantity
                END
            ) AS total_sales')
            ->value('total_sales');



        //     $totalCampaignDiscount = DB::table('order_items')
        // ->join('orders', 'order_items.order_id', '=', 'orders.id') // Join with the orders table
        // ->leftJoin('product_campaigns', 'order_items.product_id', '=', 'product_campaigns.product_id')
        // ->leftJoin('campaigns', 'product_campaigns.campaign_id', '=', 'campaigns.id')
        // ->where('orders.order_status', 'delivered') // Filter by order status
        // ->whereNotNull('campaigns.discount') // Ensure we only include valid discounts
        // ->selectRaw('COALESCE(SUM(CAST(campaigns.discount AS DECIMAL(10,2)) * order_items.quantity), 0) AS total_campaign_discount') // Default to 0 if null
        // ->value('total_campaign_discount');




        // dd($campaignDiscounts);




        // Adjust the total delivered sales by subtracting the total coupon discount
        $adjustedDeliveredSales = max($totalDelivered - ($totalCouponDiscount ?? 0), 0);

        // $adjustedTotalSales = max($totalSales - ($totalCampaignDiscount ?? 0), 0);
        $adjustedTotalSales = max($totalSales - ($totalCampaignDiscount ?? 0) - ($totalCouponDiscount ?? 0), 0);

        // Return the results as an array
        return [
            'total' => [
                'cancel' => $totalCancel,
                'delivered' => $adjustedDeliveredSales,
                'returned' => $totalReturned,
            ],
            'overall' => [
                'total_sales' => $adjustedTotalSales, // Updated overall sales
            ],
            'coupon' => [
                'total_discount' => $totalCouponDiscount ?? 0,
                'total_campaign_discount' => $totalCampaignDiscount ?? 0,
            ]
        ];
    }
}


// if (!function_exists('getOrderStatistics')) {
//     function getOrderStatistics()
//     {
//         // Helper function to calculate total sales amounts based on status, type, and discounts
//         $calculateTotalAmount = function ($status, $isType = null) {
//             $query = DB::table('order_items')
//                 ->join('orders', 'order_items.order_id', '=', 'orders.id')
//                 // Join product_campaigns and campaigns to fetch the campaign discount for each product
//                 ->leftJoin('product_campaigns', 'order_items.product_id', '=', 'product_campaigns.product_id')
//                 ->leftJoin('campaigns', 'product_campaigns.campaign_id', '=', 'campaigns.id')
//                 ->where('orders.order_status', $status);

//             // Optional filter by type (e.g., POS or online orders)
//             if ($isType) {
//                 $query->where('order_items.is_type', $isType);
//             }

//             // Calculate the total price including coupon and campaign discounts
//             $totalAmount = $query->selectRaw('SUM(
//                 CASE
//                     WHEN order_items.is_type = "pos" THEN (order_items.price * order_items.quantity)
//                     ELSE 
//                         (order_items.price - 
//                         (
//                             -- Handle coupon discount
//                             CASE 
//                                 WHEN order_items.coupon_discount_type = "percentage" AND order_items.coupon_discount IS NOT NULL
//                                 THEN (order_items.price * (order_items.coupon_discount / 100)) 
//                                 ELSE IFNULL(order_items.coupon_discount, 0)
//                             END 

//                             -- Handle campaign discount (assuming campaigns.discount is a fixed amount)
//                             - IFNULL(campaigns.discount, 0)
//                         )) * order_items.quantity
//                 END
//             ) AS total_amount')
//             ->value('total_amount');

//             // Return the calculated total or 0 if no amount
//             return $totalAmount ?? 0;
//         };

//         // Calculate total sales for different statuses
//         $totalCancel = $calculateTotalAmount('cancelled');
//         $totalDelivered = $calculateTotalAmount('delivered');
//         $totalReturned = $calculateTotalAmount('returned');

//         // Calculate overall sales for delivered orders
//         $totalSales = DB::table('order_items')
//             ->join('orders', 'order_items.order_id', '=', 'orders.id')
//             ->leftJoin('product_campaigns', 'order_items.product_id', '=', 'product_campaigns.product_id')
//             ->leftJoin('campaigns', 'product_campaigns.campaign_id', '=', 'campaigns.id')
//             ->where('orders.order_status', 'delivered') // Total sales for delivered orders only
//             ->selectRaw('SUM(
//                 CASE
//                     WHEN order_items.is_type = "pos" THEN (order_items.price * order_items.quantity)
//                     ELSE 
//                         (order_items.price - 
//                         (
//                             -- Handle coupon discount
//                             CASE 
//                                 WHEN order_items.coupon_discount_type = "percentage" AND order_items.coupon_discount IS NOT NULL
//                                 THEN (order_items.price * (order_items.coupon_discount / 100)) 
//                                 ELSE IFNULL(order_items.coupon_discount, 0)
//                             END 

//                             -- Handle campaign discount (assuming campaigns.discount is a fixed amount)
//                             - IFNULL(campaigns.discount, 0)
//                         )) * order_items.quantity
//                 END
//             ) AS total_sales')
//             ->value('total_sales');

//         // Calculate total coupon discount
//         $totalCouponDiscount = DB::table('order_items')
//             ->selectRaw('SUM(CAST(coupon_discount AS DECIMAL(10,2))) AS total_coupon_discount')
//             ->value('total_coupon_discount');

//         // Calculate total campaign discount
//         $totalCampaignDiscount = DB::table('order_items')
//             ->leftJoin('product_campaigns', 'order_items.product_id', '=', 'product_campaigns.product_id')
//             ->leftJoin('campaigns', 'product_campaigns.campaign_id', '=', 'campaigns.id')
//             ->selectRaw('SUM(CAST(campaigns.discount AS DECIMAL(10,2))) AS total_campaign_discount')
//             ->value('total_campaign_discount');

//         // Adjust delivered sales by subtracting the total coupon and campaign discounts
//         $adjustedDeliveredSales = max($totalDelivered - (($totalCouponDiscount ?? 0) + ($totalCampaignDiscount ?? 0)), 0);

//         // Adjust overall total sales by ensuring it's non-negative
//         $adjustedTotalSales = max($totalSales - (($totalCouponDiscount ?? 0) + ($totalCampaignDiscount ?? 0)), 0);

//         // Return the results as an array
//         return [
//             'total' => [
//                 'cancel' => $totalCancel,
//                 'delivered' => $adjustedDeliveredSales,
//                 'returned' => $totalReturned,
//             ],
//             'overall' => [
//                 'total_sales' => $adjustedTotalSales,
//             ],
//             'discounts' => [
//                 'total_coupon_discount' => $totalCouponDiscount ?? 0,
//                 'total_campaign_discount' => $totalCampaignDiscount ?? 0,
//             ]
//         ];
//     }
// }



if (!function_exists('getAverageRatingsByProduct')) {
    function getAverageRatingsByProduct()
    {
        $reviews = Review::all();

        $averageRatings = $reviews->groupBy('product_id')->map(function ($reviewsByProduct) {
            $average = $reviewsByProduct->avg('rating');
            $count = $reviewsByProduct->count();

            return [
                'product_id' => $reviewsByProduct->first()->product_id,
                'average_rating' => $average,
                'review_count' => $count
            ];
        });

        return $averageRatings;
    }
}




function logo()
{
    $logo = MediaFile::where('file_name', 'logo')
        ->orderBy('created_at', 'desc')
        ->first();

    return $logo ? $logo->file_path : 'public/logo.png';
}

function loding()
{
    $logo = MediaFile::where('file_name', 'loader')
        ->orderBy('created_at', 'desc')
        ->first();

    return $logo ? $logo->file_path : 'public/loading.gif';
}




if (!function_exists('getAttribute')) {
    function getAttribute($prod_id)
    {
        // return  null;
        return Product::join('product_options', 'products.id', '=', 'product_options.product_id')
            ->join('options', 'product_options.product_option_id', '=', 'options.id')
            ->join('attributes', 'options.attribute_id', '=', 'attributes.id')
            ->select(
                'products.id as product_id', // Alias to avoid conflicts

                'options.id as option_id',
                'options.name as option_name',
                // 'options.in_stock',
                // 'options.in_stock_unlimited',
                // 'options.is_color',
                // 'options.price as option_price',
                'options.attribute_id',
                'attributes.id as attribute_id',
                'attributes.name as attribute_name',

            )

            ->whereProductId($prod_id)
            ->get()->groupBy('attribute_name');
    }
}







function price($id)
{
    $product = Product::find($id);

    if (!empty($product->discount_price)) {
        $price = $product->discount_price;
    } else {
        $price = $product->price;
    }

    return $price;
}


function calculateDiscount(float $price, int $quantity, ?string $discountType, ?float $discountAmount): float
{
    if (is_null($discountType) || is_null($discountAmount) || $discountAmount <= 0) {
        return 0;
    }


    $totalPrice = $price * $quantity;
    $discount = 0;

    if ($discountType === 'percentage') {
        $discount = ($totalPrice * $discountAmount) / 100;
    } elseif ($discountType === 'fixed') {
        $discount = $discountAmount * $quantity;
    }

    return $discount;
}


function generateInvoiceId()
{

    $dayPart = now()->format('d');
    $monthPart = now()->format('m');

    // Generate a unique 4-digit number
    $uniqueNumber = rand(1000, 9999);

    // Return the invoice ID with the format: INV-DD-MM-XXXX
    return 'INV-' . $dayPart . '-' . $monthPart . '-' . $uniqueNumber;
}



// getCategoriesWithSubcategories
function getCategoriesWithSubcategories()
{
    $getCategoriesWithSubcategories = Cache::remember('categories_with_subcategories', 60, function () {
        return ProductCategory::with('subcategories')->has('subcategories')->latest()->take(14)->get();
    });
}




// app/helpers.php

if (!function_exists('truncate_comment')) {
    function truncate_comment($comment, $length = 15, $append = '...')
    {
        return mb_strlen($comment) > $length ? mb_substr($comment, 0, $length) . $append : $comment;
    }
}


//coupon value retrive

if (!function_exists('apply_coupon_discount')) {
    function apply_coupon_discount($cartId, $couponCode)
    {

        $coupon_data = DB::table('coupons')
            ->where('coupons.code', $couponCode)
            ->join('coupon_product', 'coupons.id', '=', 'coupon_product.coupon_id')
            ->join('cart_items', 'cart_items.product_id', '=', 'coupon_product.product_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->where('cart_items.cart_id', '=', $cartId)
            ->where('coupons.usage_limit', '>', 1)
            ->select('products.id', 'products.price', 'products.discount_price', 'products.campaign_price', 'coupons.discount_amount', 'coupons.discount_type', 'cart_items.quantity')
            ->get();



        session()->put('coupon_data', $coupon_data);

        $total_coupon_discount = 0;


        foreach ($coupon_data as $item) {

            if ($item->discount_type == 'percentage') {

                $coupon_discount = (($item->price - $item->discount_price) * $item->discount_amount * $item->quantity) / 100;
                $total_coupon_discount += $coupon_discount;
            }

            if ($item->discount_type == 'fixed') {
                $coupon_discount = ($item->discount_amount) * $item->quantity;
                $total_coupon_discount += $coupon_discount;
            }
        }

        return $total_coupon_discount;
    }
}
