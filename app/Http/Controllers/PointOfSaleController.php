<?php

namespace App\Http\Controllers;

use App\Models\CartManagement;
use App\Models\ItemPurchase;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\User;
use App\Traits\OrderStatisticsTrait;

class PointOfSaleController extends Controller
{
     use OrderStatisticsTrait;

    public function index()
    {
     
    
    
   
    $statistics = $this->getOrderStatisticss();

 
    $products = Product::where('is_published', 1)
    ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
    ->select('products.*', 'product_categories.name as category_name')
    ->orderBy('products.created_at', 'desc') // Fetch latest products
    ->get();
 
   
         return view('web.dashboard.pos.index',compact('products'
         ,'statistics'
         ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
