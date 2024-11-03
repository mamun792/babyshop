<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\AffiliateEarning;
use App\Models\ApiSetting;
use App\Models\Comment;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Services\DeliveryService;
use App\Traits\OrderStatisticsTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{


    protected $deliveryService;

    use OrderStatisticsTrait;

    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }


    public function index()
    {


        $filterResults = null;
        // return  $orders = Order::with('items.product')->get();


       $orders = Order::with([
            'items' => function ($query) {
                $query->select('order_items.*');
            },
            'items.product' => function ($query) {
                $query->select(
                    'products.id',
                    'products.name',
                    'products.product_code',
                    'products.discount_price',
                    'products.short_description',
                    'products.slug',
                    'products.featured_image',
                   
                );
            },
            'items.product.campaigns' => function ($query) {
                $query->select('campaigns.id', 'campaigns.discount');
            }
        ])

            ->get();


        // Calculate totals for each order
        foreach ($orders as $order) {
            $order->final_amount = $this->calculateTotal($order);
        }

        // return $orders;

        $statistics = $this->getOrderStatisticss();
        $comments = Comment::latest()->get();

        return view('web.dashboard.order.index', compact('orders', 'filterResults', 'statistics', 'comments'));
    }

    public function offile()
    {
        return view('web.dashboard.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function invoice($id)
    {
       $order = Order::with(['items.product', 'items.options'])->find($id);

     return view('web.dashboard.order.invoice', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function selectOrder()
    {

        $recentOrders = DB::table('orders as o')
            ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->leftJoin('products as p', 'oi.product_id', '=', 'p.id')
            ->select(
                'o.id as order_id',
                'o.created_at as placed_on',
                'p.name as product_name',
                'p.featured_image',
                'oi.quantity',
                'o.order_status'
            )
            ->where('o.user_id', auth()->id())
            ->orderBy('o.created_at', 'desc')
            ->get()
            ->groupBy('order_status');




        return view('web.dashboard.track-order.select-order', compact('recentOrders'));
    }

    public function returnOder()
    {
        $returnedOrders = DB::table('orders as o')
            ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->leftJoin('products as p', 'oi.product_id', '=', 'p.id')
            ->select(
                'o.id as order_id',
                'o.created_at as placed_on',
                'p.name as product_name',
                'p.featured_image',
                'oi.quantity',
                'o.order_status'
            )
            ->where('o.user_id', auth()->id())
            ->where('o.order_status', 'Returned')  // Filter by the 'Returned' status
            ->orderBy('o.created_at', 'desc')
            ->get();

        return view('web.dashboard.track-order.return-oder', compact('returnedOrders'));
    }

    public function cancelOrder()
    {
        $cancelledOrders =  DB::table('orders as o')
            ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->leftJoin('products as p', 'oi.product_id', '=', 'p.id')
            ->select(
                'o.id as order_id',
                'o.created_at as placed_on',
                'p.name as product_name',
                'p.featured_image',
                'oi.quantity',
                'o.order_status'
            )
            ->where('o.user_id', auth()->id())
            ->where('o.order_status', 'cancelled')
            ->orderBy('o.created_at', 'desc')
            ->get();

        return view('web.dashboard.track-order.cancel-order', compact('cancelledOrders'));
    }

    function filter()
    {

        $filters = [
            'product_code' => request()->product_code,
            'invoice_no' => request()->invoice_no,
            'phone' => request()->phone,
            'status' => request()->status,
            'days' => request()->days,
            'date_from' => request()->date_from,
            'date_to' => request()->date_to,
            'customer_name' => request()->customer_name
        ];



        // $query = Order::query();


        $query = Order::query()
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('orders.*'); // Adjust the columns you want to select



        if (!empty($filters['product_code'])) {
            $query->where('product_code',  $filters['product_code']);
        }
        // return $filters['invoice_no'];
        if (!empty($filters['invoice_no'])) {
            $query->where('invoice_number', 'like', '%' . $filters['invoice_no'] . '%');
        }

        if (!empty($filters['phone'])) {
            $query->where('phone_number', $filters['phone']);
        }

        if (!empty($filters['status'])) {
            $query->where('order_status', $filters['status']);
        }

        if (!empty($filters['days'])) {
            // Calculate the date from 'days' ago
            $dateFrom = Carbon::now()->subDays($filters['days']);
            $query->where('orders.created_at', '>=', $dateFrom);
        }

        if (!empty($filters['date_from']) && !empty($filters['date_to'])) {
            $query->whereBetween('orders.created_at', [$filters['date_from'], $filters['date_to']]);
        } elseif (!empty($filters['date_from'])) {
            $query->where('orders.created_at', '>=', $filters['date_from']);
        } elseif (!empty($filters['date_to'])) {
            $query->where('orders.created_at', '<=', $filters['date_to']);
        }

        if (!empty($filters['customer_name'])) {
            $query->where('customer_name', 'like', '%' . $filters['customer_name'] . '%');
        }




        // Get the results
        $filterResults = $query->get();

        $statistics = $this->getOrderStatisticss();


        return view('web.dashboard.order.index', compact('filterResults', 'statistics'));
      
    }


    public function bulkDelete()
    {
        $ids = request()->ids;
        Order::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['status' => true, 'message' => 'Order deleted successfully.']);
    }





    public function updateComment(Request $request, $id)
    {
        try {

            $request->validate([
                'comment' => 'required|string|max:255',
            ]);


            $order = Order::findOrFail($id);


            $order->comment = $request->input('comment');
            $order->save();




            return response()->json(['success' => true, 'message' => 'Comment updated successfully.']);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'Failed to update comment.']);
        }
    }



    public function bulkUpdateStatus(Request $request)
    {
        $ids = $request->input('order_ids', []);
        $status = $request->input('status');
    
        // Log the request data for debugging
        Log::info('Bulk update status request received', ['request_data' => $request->all()]);
    
        if (empty($ids) || empty($status)) {
            return back()->with('error', 'No orders selected or status not specified.');
        }
    
        $currentOrders = Order::whereIn('id', $ids)->get();
    
        // Start a transaction to handle bulk updates
        DB::transaction(function () use ($ids, $status, $currentOrders) {
            foreach ($currentOrders as $order) {
                if (!in_array($order->order_status, ['cancelled', 'returned'])) {
                    $orderItems = OrderItem::with('product')->where('order_id', $order->id)->get();
    
                    foreach ($orderItems as $orderItem) {
                        if ($orderItem->is_commission_paid == 0 && $orderItem->affiliate_refer_code != null && $status == 'delivered') {
                            $r = User::where('refer_code', $orderItem->affiliate_refer_code)->first();
                            $rproduct = Product::find($orderItem->product_id);
                            $data = [
                                'Name' => $rproduct->name ?? 'N/A',
                                'Price' => $rproduct->discount_price ?? 'N/A',
                            ];
    
                            if ($r) {
                                AffiliateEarning::create([
                                    'user_id' => $r->id,
                                    'product_details' => json_encode($data),
                                    'commission_details' => $orderItem->commission_description,
                                    'commission_amount' => $orderItem->affiliate_commission,
                                ]);
                            }
                        }
                        $r->balance +=$orderItem->affiliate_commission;
                        $r->save();
                        $orderItem->is_commission_paid = 1;
                        $orderItem->save();
    
                        $product = $orderItem->product;
                        $product->sold += $orderItem->quantity;
                        $product->quantity -= $orderItem->quantity;
                        $product->save();
                    }
                }
            }
    
            if ($status == 'delete') {
                Order::whereIn('id', $ids)->delete();
            } elseif ($status == 'sent_to_steadfast') {
                foreach ($currentOrders as $order) {
                    try {
                        $this->deliveryService->createDelivery($status, $order);
                    } catch (\Exception $e) {
                        Log::error('Error sending order to steadfast', [
                            'order_id' => $order->id,
                            'error' => $e->getMessage()
                        ]);
                        DB::rollBack();
                        return back()->with('error', 'Failed to send orders to steadfast. Please try again.')->withInput();
                    }
                }
            } elseif (in_array($status, ['cancelled', 'returned'])) {
                Order::whereIn('id', $ids)->update(['order_status' => $status]);
                $this->restoreProductQuantities($ids);
            } else {
                Order::whereIn('id', $ids)->update(['order_status' => $status]);
            }
        });
    
        toastr()->success('Orders updated successfully.');
        return back();
    }
    




    protected function restoreProductQuantities(array $ids)
    {
        $orderItems = OrderItem::with('product')->whereIn('order_id', $ids)->get();

        foreach ($orderItems as $orderItem) {
            $product = $orderItem->product;

            if ($product) {
                $product->sold -= $orderItem->quantity;
                $product->quantity += $orderItem->quantity;
                $product->save();
            }
        }
    }

    //mamun


    protected function calculateTotal(Order $order): float
    {
        $finalAmount = 0;

        foreach ($order->items as $item) {
            $finalAmount += $this->calculateItemTotal($item);
        }

        // Add delivery charge to the final amount
        $finalAmount += $order->delivery_charge;

        return max(0, $finalAmount); // Ensure the final amount does not go below zero
    }

    protected function calculateItemTotal($item): float
    {
        // Calculate total price before discounts
        $itemTotalPrice = $item->price * $item->quantity;

        // Calculate total discounts from campaign and coupon
        $campaignDiscount = $this->calculateCampaignDiscount($item);
        $couponDiscount = $this->calculateCouponDiscount($item); // New method for coupon discount

        // Calculate total after applying the discounts
        $totalAfterDiscounts = $itemTotalPrice - $campaignDiscount - $couponDiscount;

        return max(0, $totalAfterDiscounts); // Ensure we don't return a negative amount
    }

    protected function calculateCampaignDiscount($item): float
    {
        // Check if there are campaigns associated with the product and if the array has at least one campaign
        if (!empty($item->product->campaigns) && isset($item->product->campaigns[0])) {
            // Get the first campaign
            $campaign = $item->product->campaigns[0];

            // Check if the discount is set and is numeric
            if (isset($campaign->discount) && is_numeric($campaign->discount)) {
                return $campaign->discount * $item->quantity; // Apply the campaign discount per item
            }
        }

        // Return zero if there are no campaigns or the discount is not set
        return 0;
    }

    // New method to calculate coupon discounts
    protected function calculateCouponDiscount($item): float
    {
        // Check if coupon discount is set and is numeric
        if (isset($item->coupon_discount) && is_numeric($item->coupon_discount)) {
            return $item->coupon_discount * $item->quantity; // Apply the coupon discount per item
        }

        // Return zero if no coupon discount is available
        return 0;
    }
}
