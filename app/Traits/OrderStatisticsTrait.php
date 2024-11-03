<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait OrderStatisticsTrait
{
    

    public function getOrderStatisticss()
{
    $data = [];

    // Count active orders
    $data['activeOrders'] = Order::whereIn('order_status', [
        'pending', 'processing', 'sent_to_steadfast', 'pending_delivery', 'cancelled', 'returned'
    ])->count();

    // Count last 30 days orders
    $data['last30DaysOrders'] = Order::where('created_at', '>=', now()->subDays(30))->count();

    // Count pending deliveries
    $data['pendingDeliveries'] = Order::where('order_status', 'pending_delivery')->count();

    // Count processing orders
    $data['processingOrders'] = Order::where('order_status', 'processing')->count();

    // Count pending orders
    $data['pendingOrders'] = Order::where('order_status', 'pending')->count();

    // Count last 30 days processing orders
    $data['last30DaysProcessingOrders'] = Order::where('order_status', 'processing')
        ->where('created_at', '>=', now()->subDays(30))->count();

    // Count last 30 days users with pending deliveries
    $data['last30DaysPendingDeliveriesUsers'] = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->where('order_status', 'pending_delivery')
        ->where('orders.created_at', '>=', now()->subDays(30))
        ->distinct('orders.user_id')
        ->count('orders.user_id');

    // Count last 30 days processing users
    $data['last30DaysProcessingUsers'] = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->where('order_status', 'processing')
        ->where('orders.created_at', '>=', now()->subDays(30))
        ->distinct('orders.user_id')
        ->count('orders.user_id');

    // Count last 30 days pending users
    $data['last30DaysPendingUsers'] = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->where('order_status', 'pending')
        ->where('orders.created_at', '>=', now()->subDays(30))
        ->distinct('orders.user_id')
        ->count('orders.user_id');

    // Count total users
    $data['totalUsers'] = User::count();

    // Count users in the last 30 days
    $data['last30DaysUsers'] = User::where('created_at', '>=', now()->subDays(30))->count();

    // Count delivery, returned, and cancelled orders
    $data['totalDeliveryOrders'] = Order::where('order_status', 'delivered')->count();
    $data['totalReturnedOrders'] = Order::where('order_status', 'returned')->count();
    $data['totalCancelledOrders'] = Order::where('order_status', 'cancelled')->count();

    // Count returned and cancelled orders in the last 30 days
    $data['last30ReturnedOrders'] = Order::where('order_status', 'returned')
        ->where('created_at', '>=', now()->subDays(30))->count();
    $data['last30CancelledOrders'] = Order::where('order_status', 'cancelled')
        ->where('created_at', '>=', now()->subDays(30))->count();

    // Calculate monthly order statistics (for chart) dynamically
    $data['monthlyOrders'] = $this->getMonthlyOrders();

    //  total sales
   

    return $data;
}

/**
 * Get monthly order count dynamically
 *
 * @return array
 */
protected function getMonthlyOrders()
{
    $monthlyOrders = [];

    // Iterate through each month of the current year and count the orders
    for ($i = 1; $i <= 12; $i++) {
        $startOfMonth = now()->startOfYear()->addMonths($i - 1)->startOfMonth();
        $endOfMonth = now()->startOfYear()->addMonths($i - 1)->endOfMonth();

        $monthlyOrders[] = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
       // Pending orders for the month
        $monthlyPendingOrders[] = Order::where('order_status', 'pending')
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->count();
        // Processing orders for the month
        $monthlyProcessingOrders[] = Order::where('order_status', 'processing')
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->count();
        // pending_delivery orders for the month
        $monthlyPendingDeliveryOrders[] = Order::where('order_status', 'pending_delivery')
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->count();
        //  total user
        $totalUsers[] = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        // delivered orders for the month
        $monthlyDeliveredOrders[] = Order::where('order_status', 'delivered')
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->count();
        // returned orders for the month
        $monthlyReturnedOrders[] = Order::where('order_status', 'returned')
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->count();

        // cancelled orders for the month

        $totalCancelledOrders[] = Order::where('order_status', 'cancelled')
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->count();

        //  total sales
        $totalSales[] = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->whereBetween('order_items.created_at', [$startOfMonth, $endOfMonth])
        ->where('orders.order_status', 'delivered')
        ->sum('order_items.price');

        //  total returned orders sales
        $totalReturnedOrdersSales[] = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->whereBetween('order_items.created_at', [$startOfMonth, $endOfMonth])
        ->where('orders.order_status', 'returned')
        ->sum('order_items.price');

        // cancelled orders total sales
        $totalCancelledOrdersSales[] = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->whereBetween('order_items.created_at', [$startOfMonth, $endOfMonth])
        ->where('orders.order_status', 'cancelled')
        ->sum('order_items.price');
    }

   
     

    return [
        'monthlyOrders' => $monthlyOrders,
        'monthlyPendingOrders' => $monthlyPendingOrders,
        'monthlyProcessingOrders' => $monthlyProcessingOrders,
        'monthlyPendingDeliveryOrders' => $monthlyPendingDeliveryOrders,
        'totalUsers' => $totalUsers,
        'monthlyDeliveredOrders' => $monthlyDeliveredOrders,
        'monthlyReturnedOrders' => $monthlyReturnedOrders,
        'monthlyCancelledOrders' => $totalCancelledOrders,
        'totalSales' => $totalSales,
        'totalReturnedOrdersSales' => $totalReturnedOrdersSales,
        'totalCancelledOrdersSales' => $totalCancelledOrdersSales,
    ];
}

}
