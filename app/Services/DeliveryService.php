<?php

namespace App\Services;

use App\Models\ApiSetting;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeliveryService
{
    protected $api_key;
    protected $secret_key;
    protected $base_url;
    protected $steadfast;

    public function __construct()
    {
        $this->loadApiSettings();
        $this->base_url = 'https://portal.packzy.com/api/v1';
        $this->initializeHttpClient();
    }

    protected function loadApiSettings()
    {
        $apiSettings = ApiSetting::first();
        $this->api_key = $apiSettings ? $apiSettings->api_key : null;
        $this->secret_key = $apiSettings ? $apiSettings->secret_key : null;
    }

    protected function initializeHttpClient()
    {
        $this->steadfast = Http::withHeaders([
            'Api-Key' => $this->api_key,
            'Secret-Key' => $this->secret_key,
            'Content-Type' => 'application/json',
        ]);
    }

    public function createDelivery($status, Order $order)
    {
        $total = $order->total_amount;
        Log::info('Total', ['total' => $total]);



        if ($status === 'sent_to_steadfast') {
            return $this->sendToSteadfast($order, $total);
        }

        $order->update(['order_status' => $status]);
        toastr()->success('Order status updated successfully');

        return back();
    }
  



    protected function sendToSteadfast(Order $order, $total)
    {
        try {
            // Log::info('Steadfast API Request', $this->logRequestData($order, $total));

            $response = $this->steadfast->post("{$this->base_url}/create_order", [
                'invoice' => $order->invoice_number,
                'recipient_name' => $order->customer_name,
                'recipient_phone' => $order->phone_number,
                'recipient_address' => $order->address,
                'cod_amount' => $total,
                'note' => $order->remarks,
            ]);

            return $this->handleResponse($response, $order);
        } catch (\Exception $e) {
            //  Log::error('Exception during API request', ['exception' => $e->getMessage()]);
            toastr()->error('Error sending order to Steadfast: ' . $e->getMessage());
            return back();
        }
    }

    protected function logRequestData(Order $order, $total)
    {
        return [
            'url' => "{$this->base_url}/create_order",
            'headers' => [
                'Api-Key' => $this->api_key,
                'Secret-Key' => $this->secret_key,
            ],
            'data' => [
                'invoice' => $order->invoice_number,
                'recipient_name' => $order->customer_name,
                'recipient_phone' => $order->phone_number,
                'recipient_address' => $order->address,
                'cod_amount' => $total,
                'note' => $order->remarks,
            ],
        ];
    }

    protected function handleResponse($response, Order $order)
    {
        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['consignment'])) {
                $order->update([
                    'consignment_id' => $data['consignment']['consignment_id'],
                    'steadfast_status' => $data['consignment']['status'],
                    'order_status' => 'sent_to_steadfast',
                ]);
                toastr()->success('Order sent to Steadfast successfully');
            } else {
                Log::error('Unexpected API response format', ['response' => $data]);

                $errorMessage = 'Unexpected response from Steadfast.';

                if (isset($response['errors']['recipient_phone'])) {
                    // Extract the first error message
                    $errorMessage = $response['errors']['recipient_phone'][0];
                } else {
                    // Fallback error message if no specific error is found
                    $errorMessage = 'An unknown error occurred.';
                }

                $responseDetails = $this->formatResponseDetails($response);


                // Combine error message with response details
                toastr()->error($errorMessage);


                return back();
            }
        } else {
            //Log::error('API request failed', ['status' => $response->status(), 'body' => $response->body()]);
            toastr()->error('Error during API request: ' . $response->body());
            return back();
        }

        return back();
    }

    protected function formatResponseDetails($response)
    {
        return "Status: {$response->status()}\nBody: {$response->body()}";
    }
}