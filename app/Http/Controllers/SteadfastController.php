<?php

namespace App\Http\Controllers;

use App\Models\ApiSetting;
use App\Models\Order;
use App\Services\DeliveryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class SteadfastController extends Controller
{

    // protected $api_key;
    // protected $secret_key;
    // protected $base_url;
    // protected $steadfast;

    protected $deliveryService;

   

    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }
   

    public function createDelivery($status, Order $order)
    {
        if ($status === 'sent_to_steadfast') {
            return $this->deliveryService->createDelivery($status, $order);
        }

        $order->update(['order_status' => $status]);

        toastr()->success('Order status updated successfully');

        

        return back();
    }
}
