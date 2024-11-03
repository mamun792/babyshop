<?php

namespace App\Http\Controllers;

use App\Models\ItemPurchase;
use App\Models\MediaFile;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCampaign;
use App\Models\User;
use App\Traits\OrderStatisticsTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Metadata\Uses;

class DashboardController extends Controller
{

    use OrderStatisticsTrait;

    public function index()
    {

        //return Order::with('orderItems')->get();


        $orderStatistics = getTotalPendingOrdersByMonth();

        $statistics = $this->getOrderStatisticss();

        $totalOrderStatistics = getOrderStatistics();

        $last30daysReturn = Order::where('order_status', 'returned')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();

        $last30daysCancel = Order::where('order_status', 'cancelled')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();



        $latestOrderItems =  OrderItem::all()
            ->groupBy('order_id')
            ->map->last()
            ->pluck('id');



        $last30daysTotalSalesDeliveredOrders = Order::where('order_status', 'delivered')->count();
        $last30daysReturn = Order::where('order_status', 'returned')->count();


        $totalCouponDiscount = OrderItem::whereIn('id', $latestOrderItems)
            ->sum('coupon_discount');


        $totalCouponDiscount = $totalCouponDiscount = OrderItem::whereIn('id', $latestOrderItems)
            ->sum('coupon_discount');










      $orders = Order::with(['orderItems' => function ($query) {
            $query->select('id', 'order_id', 'product_id', 'quantity', 'price', 'coupon_code', 'coupon_discount', 'coupon_discount_type');
        }])
            ->limit(5)
            ->get()
            ->filter(function ($order) {
                return $order->orderItems->isNotEmpty();
            })
            ->map(function ($order) {
                $userName = $order->customer_name ?: 'Unknown User';

               
                $productIds = $order->orderItems->pluck('product_id')->unique();

                
                $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

                $productData = $order->orderItems->map(function ($item) use ($products) {
                    $product = $products->get($item->product_id); 


                    $finalPrice = ($item->price * $item->quantity); 

                    return [
                        'name' => $product->name ?? 'Unknown Product',
                        'total_quantity' => $item->quantity, 
                        'total_price' => $finalPrice,
                    
                        'coupon_code' => $item->coupon_code,
                        'coupon_discount' => $item->coupon_discount,
                    ];
                });

                return [
                    'user_name' => $userName,
                    'total_amount'=> $order->total_amount,
                    'invoice_number' => $order->invoice_number,
                    'order_status' => $order->order_status,
                    'products' => $productData,
                    'total_quantity' => $order->orderItems->sum('quantity'),
                ];
            });

        // -------------------------------



      $topCustomers = User::with(['orders' => function ($query) {
        $query->where('order_status', 'delivered'); 
    }])
    ->get()
    ->map(function ($user) {
        $totalOrderValue = $user->orders->sum('total_amount'); 
    
        return [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_phone' => $user->phone,
            'user_avatar' => $user->avatar,
            'total_order_value' => $totalOrderValue,
            'order_count' => $user->orders->count(),
        ];
    })
    ->filter(function ($customer) {
        return $customer['order_count'] > 0; 
    })
    ->sortByDesc('order_count')
    ->take(10)
    ->values(); 
    






      $topSellingProducts = Product::with(['orderItems' => function ($query) {
            $query->select('product_id', 'order_id', 'quantity', 'coupon_discount_type', 'coupon_discount');
        }])
            ->select('products.id as product_id', 'products.name as product_name', 'products.price as product_price', 'products.discount_price as discount_price')
            ->withSum('orderItems', 'quantity')
            ->withCount('orderItems as total_orders')
            ->withMax('orderItems', 'coupon_discount_type')
            ->withMax('orderItems', 'coupon_discount')
            ->has('orderItems')
            ->orderByDesc('total_orders')
            ->limit(10)
            ->get();


        $topSellingProducts->transform(function ($product) {
            $totalSalesValue = 0;

            if ($product->orderItems->isNotEmpty()) {
                foreach ($product->orderItems as $item) {
                    $discount = 0;


                    if ($item->coupon_discount_type === 'percentage') {
                        $discount = $product->product_price * $item->coupon_discount / 100;
                    } elseif ($item->coupon_discount_type === 'fixed') {
                        $discount = $item->coupon_discount;
                    }


                    $totalSalesValue += $item->quantity * ($product->product_price - $discount);
                }
            }


            $product->total_sales_value = $totalSalesValue ?: 0;

            return $product;
        });


        $stockReport = Product::select(
            'name AS product_name',
            'price',
            'quantity',
            'sold'
        )
            ->where('is_published', 1)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {

                $item->total_handled_stock = $item->quantity + $item->sold;


                return $item;
            });



        return view('web.dashboard.dashboard', [
            'orderStatistics' => $orderStatistics,
            'data' => $totalOrderStatistics,
            'orders' => $orders,
            'topCustomers' => $topCustomers,
            'topSellingProducts' => $topSellingProducts,
            'stockReport' => $stockReport,
            'totalCouponDiscount' => $totalCouponDiscount,
            'last30daysReturn' => $last30daysReturn,
            'last30daysCancel' => $last30daysCancel,
            'last30daysTotalSalesDeliveredOrders' => $last30daysTotalSalesDeliveredOrders,
            'last30daysReturn' => $last30daysReturn,
            'statistics' => $statistics,
        ]);
    }

    public function getOrderStatistics()
    {
        $orderCounts = DB::table('orders')
            ->select(DB::raw('order_status, COUNT(*) as count'))
            ->groupBy('order_status')
            ->pluck('count', 'order_status')
            ->toArray();


        $statuses = [
            'pending' => 0,
            'processing' => 0,
            'delivered' => 0,
            'cancelled' => 0,
            'sent_to_steadfast' => 0,
            'pending_delivery' => 0,
            'returned' => 0,
        ];

        $orderCounts = array_merge($statuses, $orderCounts);

        return response()->json($orderCounts);
    }
}
