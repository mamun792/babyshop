<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AddressBookController extends Controller
{
    public function index()
    {
        $addresses = UserAddress::where('user_id', auth()->id())->get();
        return view('web.dashboard.address-book.index', compact('addresses'));
    }

    public function create()
    {
        return view('web.dashboard.address-book.create');
    }

    public function edit()
    {
        return view('web.dashboard.address-book.edit-address');
    }

    // public function manageAddress()
    // {
    //     $user = auth()->user();
    //   $defaultDelivery = DB::table('user_addresses')
    //   ->where('user_id', $user->id)
    //   ->where('is_default_delivery', true)
    //   ->first();
    //   $defaultBilling = DB::table('user_addresses')
    //     ->where('user_id', $user->id)
    //     ->where('is_default_billing', true)
    //     ->first();



    //  $user_id = $user->id;

    //  $recentOrders = DB::table('orders as o')
    //  ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
    //  ->leftJoin('products as p', 'oi.product_id', '=', 'p.id')
    //  ->select(
    //      'o.id as order_id',
    //      'o.user_id',
    //      'o.customer_name',
    //      'o.address',
    //      'o.phone_number',
    //      'o.note',
    //     //  'o.area',
    //      'o.payment_method',
    //      'o.delivery',
    //      'o.delivery_charge',
    //      'o.order_status',
    //      'o.steadfast_status',
    //      'o.consignment_id',
    //      'o.comment',
    //      'o.invoice_number',
    //      'o.created_at',
    //      'o.updated_at',
    //      'p.name as product_name',
    //      'p.featured_image',
    //      'oi.quantity',
    //      'oi.price',
    //      DB::raw('(oi.quantity * oi.price) AS item_total'),
    //      DB::raw('SUM(oi.quantity * oi.price) AS total_price'),
    //      DB::raw('
    //          COALESCE(
    //              CASE 
    //                  WHEN oi.coupon_discount_type = "fixed" 
    //                  THEN SUM(oi.quantity * oi.price) - oi.coupon_discount 
    //                  WHEN oi.coupon_discount_type = "percentage" 
    //                  THEN SUM(oi.quantity * oi.price) * (1 - (oi.coupon_discount / 100)) 
    //                  ELSE SUM(oi.quantity * oi.price) 
    //              END, 
    //          0) AS final_total_price'
    //      )
    //  )
    //  ->where('o.user_id', $user_id)
    //  ->groupBy(
    //      'o.id', 
    //      'o.user_id', 
    //      'o.customer_name', 
    //      'o.address', 
    //      'o.phone_number', 
    //      'o.note', 
    //     //  'o.area', 
    //      'o.payment_method', 
    //      'o.delivery', 
    //      'o.delivery_charge', 
    //      'o.order_status', 
    //      'o.steadfast_status', 
    //      'o.consignment_id', 
    //      'o.comment', 
    //      'o.invoice_number', 
    //      'o.created_at', 
    //      'o.updated_at',
    //      'p.name',
    //      'p.featured_image',
    //      'oi.quantity',
    //      'oi.price',
    //      'oi.coupon_discount_type',
    //      'oi.coupon_discount'
    //  )
    //  ->orderBy('o.created_at', 'desc')
    //  ->get();



    //     return view('web.dashboard.user.index',compact('user','defaultDelivery','defaultBilling','recentOrders'));
    // }


    public function manageAddress()
    {
        $user = auth()->user();


        $defaultDelivery = $user->addresses()->where('is_default_delivery', true)->first();
        $defaultBilling = $user->addresses()->where('is_default_billing', true)->first();


        $recentOrders = $user->orders()
            ->with([
                'orderItems' => function ($query) {
                    $query->select('id', 'order_id', 'product_id', 'quantity', 'price', 'coupon_discount_type', 'coupon_discount');
                },
                'orderItems.product' => function ($query) {
                    $query->select('id', 'name', 'featured_image');
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();


        $transformedOrders = [];


        foreach ($recentOrders as $order) {
            $orderTotal = 0;
            $finalTotalPrice = 0;
            $items = [];

            foreach ($order->orderItems as $item) {
                $itemTotal = $item->quantity * $item->price;
                $orderTotal += $itemTotal;


                switch ($item->coupon_discount_type) {
                    case 'fixed':
                        $finalTotalPrice += $itemTotal - $item->coupon_discount;
                        break;
                    case 'percentage':
                        $finalTotalPrice += $itemTotal * (1 - ($item->coupon_discount / 100));
                        break;
                    default:
                        $finalTotalPrice += $itemTotal;
                        break;
                }


                $items[] = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'name' => $item->product->name,
                    'featured_image' => $item->product->featured_image,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $itemTotal,
                ];
            }


            $transformedOrders[] = [
                'id' => $order->id,
                'invoice_number' => $order->invoice_number,
                'created_at' => $order->created_at->format('d/m/Y'),
                'delivery_charge' => $order->delivery_charge,
                'total_price' => $orderTotal,
                'final_total_price' => $finalTotalPrice + $order->delivery_charge,
                'items' => $items,
            ];
        }

        return view('web.dashboard.user.index', [
            'defaultDelivery' => $defaultDelivery,
            'defaultBilling' => $defaultBilling,
            'user' => $user,
            'transformedOrders' => $transformedOrders,
        ]);
    }





    public function profileEdit($id)
    {
        $user = auth()->user();
        return view('web.dashboard.user.edit', compact('user'));
    }




    public function store(StoreUserAddressRequest $request)
    {
        $validated = $request->validated();

       
        $validated['is_default_delivery'] = $request->has('is_default_delivery');
        $validated['is_default_billing'] = $request->has('is_default_billing');
        $validated['user_id'] = auth()->id();


        $this->updateDefaultAddresses($validated);


        UserAddress::create($validated);

        toastr()->success('Address added successfully');

        return back();
    }

    public function updateAdd(UpdateUserAddressRequest $request)
    {
        $id = $request->id;
        $validated = $request->validated();

        
        $address = UserAddress::findOrFail($id);


        $validated['is_default_delivery'] = $request->has('is_default_delivery');
        $validated['is_default_billing'] = $request->has('is_default_billing');

       
        $this->updateDefaultAddresses($validated, $id);

       
        $address->update($validated);

        toastr()->success('Address updated successfully');

        return back();
    }

    private function updateDefaultAddresses(array $validated, $currentId = null)
    {
        $userId = auth()->id();

      
        if ($validated['is_default_delivery']) {
            UserAddress::where('user_id', $userId)
                ->where('is_default_delivery', true)
                ->where('id', '!=', $currentId) // Avoid updating the current address
                ->update(['is_default_delivery' => false]);
        }

       
        if ($validated['is_default_billing']) {
            UserAddress::where('user_id', $userId)
                ->where('is_default_billing', true)
                ->where('id', '!=', $currentId)
                ->update(['is_default_billing' => false]);
        }
    }

    public function show($id)
    {
        $address = UserAddress::findOrFail($id);
        return response()->json($address);
    }


    public function destroy($id)
    {
        $address = UserAddress::findOrFail($id);
        $address->delete();

        toastr()->success('Address deleted successfully');
        return back();
    }

    public function updatePersonalInfo(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
        ]);
        $user = auth()->user();
        $user->update($request->all());

        toastr()->success('Personal info updated successfully');
        return back();
    }
}
