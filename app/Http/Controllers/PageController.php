<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $policies = $this->getPoliciesByType('privacy-policy');
        return view('web.dashboard.pages.privacy-policy', compact('policies'));
    }

    public function condition()
    {
        $condition = $this->getPoliciesByType('terms-conditions');
        return view('web.dashboard.pages.terms-and-conditions', compact('condition'));
    }

    public function refund()
    {
        $refund = $this->getPoliciesByType('return-refund-policy');
        return view('web.dashboard.pages.return-and-refund-policy', compact('refund'));
    }

    public function saleSupport()
    {
        $saleSupport = $this->getPoliciesByType('sale-support');
        return view('web.dashboard.pages.after-sale-support', compact('saleSupport'));
    }

    public function shippingDelivery()
    {
        $shipping = $this->getPoliciesByType('shipping-delivery');
        return view('web.dashboard.pages.shipping-or-delivery', compact('shipping'));
    }

    public function update(Request $request)
    {
        return $this->handlePolicyUpdate($request);
    }

    public function conditionUpdate(Request $request)
    {
        return $this->handlePolicyUpdate($request);
    }

    public function refundUpdate(Request $request)
    {
        return $this->handlePolicyUpdate($request);
    }

    public function saleSupportUpdate(Request $request)
    {
        return $this->handlePolicyUpdate($request);
    }

    public function shippingDeliveryUpdate(Request $request)
    {
        return $this->handlePolicyUpdate($request);
    }

    private function getPoliciesByType(string $type)
    {
        return Policy::where('type', $type)->get();
    }

    private function handlePolicyUpdate(Request $request)
    {
        $this->validateRequest($request);

       
        $policy = Policy::where('type', $request->type)->first();

        if ($policy) {
           
            $this->updatePolicy($policy, $request->meta_description);
            return redirect()->back()->with('success', "{$request->type} updated successfully!");
        } else {

            $this->createPolicy($request->type, $request->meta_description);
            return redirect()->back()->with('success', "{$request->type} created successfully!");
        }
    }

    private function updatePolicy(Policy $policy, string $metaDescription)
    {
        $policy->content = $metaDescription;
        $policy->save();
    }

    private function createPolicy(string $type, string $metaDescription)
    {
        Policy::create([
            'type' => $type,
            'content' => $metaDescription,
        ]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'meta_description' => 'required|string',
        ]);
    }
}
