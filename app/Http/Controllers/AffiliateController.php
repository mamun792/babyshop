<?php

namespace App\Http\Controllers;

use App\Models\AffiliateWithdraw;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Traits\ImageManipulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AffiliateController extends Controller
{
    use ImageManipulation;
    public function index()
    {
        $user = Auth::user();
        $withdraws = $user->withdraws;
        $earnings = $user->earnings;

        // my add

        $refer_code = $user->refer_code;
        // oderItem table ref_id = refer_code then get all data from orderItem table

        $orderItems = OrderItem::where('order_items.affiliate_refer_code', $refer_code)
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'order_items.id as order_item_id',
                'orders.id as order_id',
                'orders.user_id',
                'users.name as customer_name',
                'orders.order_status',
                'orders.phone_number',
                'orders.invoice_number',
                'orders.payment_method',
                'orders.total_amount',
                'products.id as product_id',
                'products.name as product_name',
                'products.commission_type',
                'products.commission_amount',
                'products.featured_image'
            )
            ->get();




        return view('web.dashboard.affiliate.dashboard', compact('user', 'earnings', 'withdraws', 'orderItems'));
    }

    public function allProduct()
    {
        return $products = Product::where('is_affiliate', 1)->get();
    }
    public function commission()
    {
        return "commision";
    }

    public function withdraw()
    {
        return "withdraw";
    }

    public function earning()
    {
        $user = Auth::user();
        $earnings = $user->earnings;
        return view('web.dashboard.affiliate.earning', compact('user', 'earnings'));
    }


    public function products()
    {
        $products = Product::where('is_affiliate', 1)->get();
        return view('web.dashboard.affiliate.products', compact('products'));
    }

    public function reports(Request $request)
    {

        $user = Auth::user();

       
        if (empty($user->refer_code)) {
            return response()->json(['message' => 'No referral code found.'], 404);
        }

        $refer_code = $user->refer_code;

        
        $query = OrderItem::where('order_items.affiliate_refer_code', $refer_code)
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'order_items.id as order_item_id',
                'order_items.quantity',
                'orders.id as order_id',
                'orders.user_id',
                'users.name as customer_name',
                'orders.order_status',
                'orders.phone_number',
                'orders.invoice_number',
                'orders.payment_method',
                'orders.total_amount',
                'products.id as product_id',
                'products.name as product_name',
                'products.commission_type',
                'products.commission_amount',
                'products.featured_image'
            );

        // Handle date range filtering
        if ($request->filled('start_date')) {
            $query->where('orders.created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('orders.created_at', '<=', $request->end_date);
        }

        // Handle predefined filters
        switch ($request->date_filter) {
            case 'today':
                $query->whereDate('orders.created_at', today());
                break;
            case 'yesterday':
                $query->whereDate('orders.created_at', today()->subDay());
                break;
            case 'this_week':
                $query->whereBetween('orders.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('orders.created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
                break;
            case 'this_month':
                $query->whereMonth('orders.created_at', now()->month);
                break;
            case 'last_month':
                $query->whereMonth('orders.created_at', now()->subMonth()->month);
                break;
        }

        // Get the filtered data
       $orderItems = $query->get();



        return view('web.dashboard.affiliate.reports', compact('orderItems'));
    }

    public function settings()
    {
        return view('web.dashboard.affiliate.settings');
    }

    public function basicUpdate(Request $request)
    {

        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'required|numeric',
            'street_address' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Update user's basic information
        $user = auth()->user();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->street_address = $validatedData['street_address'];

        // Handle avatar file upload if present
        if ($request->hasFile('avatar')) {
            $imagePath = $this->storeImage($request, 'avatar', 'profiles');
            $user->avatar = $imagePath;
        }

        // Save updated user data
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    public function passwordUpdate(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = auth()->user();

        // Check if the current password is correct
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the user's password
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function paymentUpdate(Request $request)
    {
        // Validate the request data based on the payment method type
        $validatedData = $request->validate([
            'name' => 'required|in:bkash,nagad,bank',
            'info.account_number' => 'required_if:name,bkash|required_if:name,nagad',
            'info.bank_name' => 'required_if:name,bank',
            'info.account_holder' => 'required_if:name,bank',
            'info.bank_account_number' => 'required_if:name,bank',
            'info.routing_number' => 'required_if:name,bank',
            'info.branch_name' => 'required_if:name,bank',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Prepare the info array based on the payment method type
        if ($validatedData['name'] === 'bkash' || $validatedData['name'] === 'nagad') {
            $info = [
                'account_number' => $validatedData['info']['account_number'],
            ];
        } else { // bank
            $info = [
                'bank_name' => $validatedData['info']['bank_name'],
                'account_holder' => $validatedData['info']['account_holder'],
                'bank_account_number' => $validatedData['info']['bank_account_number'],
                'routing_number' => $validatedData['info']['routing_number'],
                'branch_name' => $validatedData['info']['branch_name'],
            ];
        }

        // Check if user already has a payment method
        $paymentMethod = $user->paymentMethod;

        if ($paymentMethod) {
            // Update existing payment method
            $paymentMethod->update([
                'name' => $validatedData['name'],
                'info' => json_encode($info),
            ]);
        } else {
            // Create a new payment method
            $user->paymentMethod()->create([
                'name' => $validatedData['name'],
                'info' => json_encode($info),
            ]);
        }
        return redirect()->back()->with('success', 'Payment method updated successfully.');
    }

    public function paymentRequest(Request $request)
    {
        // Validate the request input for the amount
        $request->validate([
            'amount' => 'required|numeric|min:0|max:' . Auth::user()->balance,
        ]);

        $user = Auth::user();

        // Check if the user has a payment method
        if (!$user->paymentMethod) {
            return redirect()->back()->with(['info' => 'No payment method available. Please set up a payment method first.']);
        }
        $paymentMethod = $user->paymentMethod->info;
        $paymentMethod = ['Method Name' => $user->paymentMethod->name] + $paymentMethod;
        // Proceed to make the withdrawal
        try {
            // Create the withdrawal record
            $withdraw = new AffiliateWithdraw();
            $withdraw->user_id = $user->id;
            $withdraw->payment_method = json_encode($paymentMethod);
            $withdraw->amount = $request->amount;
            $withdraw->status = 'unpaid';
            $withdraw->save();

            // Decrease the user's balance
            $user->balance -= $request->amount;
            $user->save();

            return redirect()->route('dashboard.affiliate.payment')->with('success', 'Withdrawal request has been successfully submitted.');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'There was an error processing your request. Please try again later.']);
        }
    }


    public function payment()
    {
        $user = Auth::user();
        $withdraws = $user->withdraws;
        return view('web.dashboard.affiliate.payment', compact('withdraws', 'user'));
    }
}
