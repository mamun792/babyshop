<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Option;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrInterface;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Attribute::with('options')->get();
        return view("web.dashboard.attribute.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Attribute::with('options')->get();

        return view("web.dashboard.attribute.create", compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Attribute::create($request->except('_token'));
        toastr()->success('Your account has been suspended.');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
       
       $data = $attribute->with('options')->find($attribute->id);
         
        if (!$data) {
            toastr()->error('Attribute not found.');
            return back();
        }

        return view("web.dashboard.attribute.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $attribute->update($request->except('_token'));
        toastr()->success('Attribute deleted.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        toastr()->error('Attribute deleted.');
        return back();
    }


    function optionAdd()
    {
        return view('web.dashboard.option.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function optionStore(Request $request, Attribute $attribute)
    {

        // return $request->all();



        $attribute->options()->create([
            'name' => $request->name,
            // 'in_stock' => $request->in_stock,
            // 'in_stock_unlimited' => $request->in_stock_unlimited ? 1 : 0,
            // 'price' => $request->price,
        ]);



        return redirect()->route('dashboard.attribute.index')->with('success', 'Option added to the attribute.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function optionEdit(Option $option)
    {

        // $attribute = Attribute::findOrFail($id);
        return view('web.dashboard.option.edit', compact('option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function optionUpdate(Request $request, Option $option)
    {
        
        $validated = $request->validate([
            'name' => 'required',
            // 'in_stock' => 'required',
            // 'in_stock_unlimited' => 'required',
            // 'price' => 'required',
        ]);

        $option->update([
            'name' => $request->name,
            // 'in_stock' => $request->in_stock,
            // 'in_stock_unlimited' => $request->in_stock_unlimited ? 1 : 0,
            // 'price' => $request->price,
        ]);

        return redirect()->route('dashboard.attribute.index')->with('success', 'Option updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function optionDestroy(Option $option)
    {

        $option->delete();
        toastr()->error('Option deleted.');
        return redirect()->route('dashboard.attribute.index');
    }
}
