<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index(){

    }
    public function create(){
      $settings = GeneralSetting::first();
       return view('web.dashboard.generalSettings.create',compact('settings'));
    }

   
    public function update(Request $request)
    {
      

        GeneralSetting::updateOrCreate(
            ['id' => 1], 
            $request->all() 
        );

        toastr()->success('Settings updated successfully.');

        return back()->with('success', 'Settings updated successfully.');
    }
}
