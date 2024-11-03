<?php

namespace App\Http\Controllers;

use App\Models\ApiSetting;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $steadfast = ApiSetting::first();
        return view('web.dashboard.api.steadfast-courier', compact('steadfast'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'api_key' => 'required|string',
            'secret_key' => 'required|string',
        ]);

        ApiSetting::updateOrCreate(
            ['id' => 1], 
            [
                'api_key' => $validated['api_key'],
                'secret_key' => $validated['secret_key'],
            ]
        );

        toastr()->success('API settings saved successfully');
        return response()->json(['message' => 'API settings saved successfully'], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    public function baksh ()
    {
        return view('web.dashboard.api.baksh-courier');
    }

    public function sscommerce ()
    {
        return view('web.dashboard.api.sscommerce');
    }

    public function amerpay ()
    {
        return view('web.dashboard.api.amerpay');
    }
}
