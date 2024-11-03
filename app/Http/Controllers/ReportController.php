<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function profitLoss()
    {
        //return OrderItem::all();
        return view('web.dashboard.report.profitLoss');
    }

    public function stock()
    {
        return  view('web.dashboard.report.stock');
    }


    public function order(Request $request)
    {

        // Step 1: Define the base query with eager loading and filter to limit items
        $query = Order::with(['orderItems' => function ($query) {
            $query->select('id', 'order_id', 'product_id', 'quantity', 'price', 'coupon_code', 'coupon_discount', 'coupon_discount_type');
        }])
            ->orderBy('created_at', 'desc') ;
            

        // Step 2: Apply date filters if necessary
        $this->applyDateFilters($query, $request);

        // Step 3: Execute the query and process each order
     $orders = $query->get()
            ->filter(fn($order) => $order->orderItems->isNotEmpty()) // Only keep orders with items
            ->map(function ($order) {
                // Fallback for customer name
                $userName = $order->customer_name ?: 'Unknown User';

                // Get unique product IDs from order items and fetch product details
                $productIds = $order->orderItems->pluck('product_id')->unique();
                $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

                // Process each order item to calculate final price and product data
                $productData = $order->orderItems->map(function ($item) use ($products) {
                    $product = $products->get($item->product_id);

                    return [
                        'name' => $product->name ?? 'Unknown Product',
                        'total_quantity' => $item->quantity,
                        'total_price' => $item->price * $item->quantity,
                        'coupon_code' => $item->coupon_code,
                        'coupon_discount' => $item->coupon_discount,
                        'created_at' => $item->created_at,
                    ];
                });

                // Structure the response data for each order
                return [
                    'user_name' => $userName,
                    'total_amount' => $order->total_amount,
                    'invoice_number' => $order->invoice_number,
                    'order_status' => $order->order_status,
                    'products' => $productData,
                    'created_at' => $order->created_at,
                    'total_quantity' => $order->orderItems->sum('quantity'),
                ];
            });

        // Calculate the total price across all orders
        $totalPrice = $orders->sum('total_amount');

        // Return the view with all necessary data
        return view('web.dashboard.report.order', compact('orders', 'totalPrice' ));
    }

    private function applyDateFilters($query, $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $dateFilter = $request->query('date_filter');

        if ($startDate && $endDate) {
            if ($startDate <= $endDate) {
                $query->whereBetween('orders.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            } else {
                Log::warning('Invalid date range', ['start_date' => $startDate, 'end_date' => $endDate]);
            }
        } elseif ($startDate) {
            $query->whereDate('orders.created_at', '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate('orders.created_at', '<=', $endDate);
        } elseif ($dateFilter) {
            $this->applyPredefinedDateFilter($query, $dateFilter);
        }
    }



    private function applyPredefinedDateFilter($query, $dateFilter)
    {
        $now = Carbon::now();

        switch ($dateFilter) {
            case 'today':
                $query->whereDate('orders.created_at', $now->toDateString());
                break;
            case 'yesterday':
                $query->whereDate('orders.created_at', $now->subDay()->toDateString());
                break;
            case 'last_7_days':
                $query->whereDate('orders.created_at', '>=', $now->subDays(7)->toDateString());
                break;
            case 'this_month':
                $query->whereMonth('orders.created_at', $now->month);
                break;
            case 'last_month':
                $query->whereMonth('orders.created_at', $now->subMonth()->month);
                break;
            default:
                Log::warning('Invalid date filter', ['date_filter' => $dateFilter]);
                break;
        }
    }




    public function orderProfit()
    {
        return view('web.dashboard.report.orderProfit');
    }

    public function saleProfit()
    {
        return view('web.dashboard.report.scaleProfit');
    }




    public function supplier()
    {
        return view('web.dashboard.report.supplier');
    }

    public function account()
    {
        $orderItems = OrderItem::all();


        $totalCredit = $orderItems->sum('price');

        $totalDebit = 0;


        $totalBalance = $totalCredit - $totalDebit;
        return view('web.dashboard.report.account');
    }
}
