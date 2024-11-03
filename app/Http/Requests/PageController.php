<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public  function index(){
        $policies = Policy::where('type', 'privacy-policy')->get();
        return view('web.dashboard.pages.privacy-policy',compact('policies'));
    }

    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'type' => 'required|string',
            'meta_description' => 'required|string',
        ]);
    

         $policy = Policy::where('type', $request->type)->first();
    

        if ($policy) {

            $policy->content = $request->meta_description;
            $policy->save();
    
            return redirect()->back()->with('success', 'Policy updated successfully!');
        } else {

            return redirect()->back()->with('error', 'Policy not found.');
        }
    }

    public function condition(){
     $condition=Policy::where('type','terms-conditions')->get();
        return view('web.dashboard.pages.terms-and-conditions',compact('condition'));
    }
    

    public function conditionUpdate(Request $request){
        $request->validate([
            'type' => 'required|string',
            'meta_description' => 'required|string',
        ]);

        $conditions = Policy::where('type', $request->type)->first();
    

        if ($conditions) {

            $conditions->content = $request->meta_description;
            $conditions->save();
    
            return redirect()->back()->with('success', ' $conditions updated successfully!');
        } else {

            return redirect()->back()->with('error', ' $conditions not found.');
        }


    }
    
}
