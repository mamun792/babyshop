<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.dashboard.supplier.index');	
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        $request->validated();
        Supplier::create($request->except('_token'));
        toastr()->success('Supplier created successfully');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('web.dashboard.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->except('_token'));
        toastr()->success('Supplier updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
       // soft delete
        $supplier->delete();
        toastr()->success('Supplier deleted successfully');
        return back();
    }

    function list() {
        $suppliers = Supplier::all();
        return view('web.dashboard.supplier.list', compact('suppliers'));	
    }


    public function trashed()
    {
         $suppliers= Supplier::onlyTrashed()->get();
        
        return view('web.dashboard.supplier.trashed', compact('suppliers'));
    }

    public function restore($id)
    {
        $supplier = Supplier::onlyTrashed()->findOrFail($id);
        $supplier->restore();
        toastr()->success('Supplier restored successfully');
       return back();
    }

    public function forceDelete($id)
    {
        $supplier = Supplier::onlyTrashed()->findOrFail($id);
        $supplier->forceDelete();
        toastr()->success('Supplier deleted permanently');
        return back();
    }

}
