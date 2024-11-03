<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\ItemPurchase;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $limit = $this->getStockAlertQuantity();
        $data = $this->getProductsWithPurchases();

       $total=$data->sum('price');
       $sold=$data->sum('sold');
      
      $quantity=$data->sum(function ($d) {
        return $d->quantity+$d->sold;
    });

    $instock=$data->sum(function ($d) {
        return $d->quantity-$d->sold;
    });

       $totalValue = $data->sum(function ($d) {
        return ($d->price * $d->quantity) + ($d->price * $d->sold);
    });

        return view('web.dashboard.stock.index', compact('data', 'limit','total','totalValue','quantity','sold','instock'));
    }

    public function stock_out()
    {
        $data = $this->getProductsWithPurchases();

        $data = $data->filter(function ($item) {
            return $item->quantity == 0;
        });

        return view('web.dashboard.stock.out', compact('data'));
    }

    public function upcoming()
    {
        $stockAlertQuantity = $this->getStockAlertQuantity();
        $data = $this->getProductsWithPurchases()->map(function ($product) use ($stockAlertQuantity) {
            $product->remaining_quantity = (int) $product->quantity;
            $product->stockout = $product->remaining_quantity < $stockAlertQuantity;
            return $product;
        });

        return view('web.dashboard.stock.upcomingProduct', compact('data'));
    }

    private function getStockAlertQuantity()
    {
        return GeneralSetting::first()->stock_alert_quantity ?? 5;
    }

    private function getProductsWithPurchases()
    {
        return $products = Product::select('id', 'name', 'price', 'quantity','sold','product_code')->get();

    }
}
?>