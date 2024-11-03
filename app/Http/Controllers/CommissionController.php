<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index(){
        return view('web.dashboard.products.commission');
    }

    public function withdrawRequest(){
        return view('web.dashboard.affiliate.withdraw-request');
    }
}
