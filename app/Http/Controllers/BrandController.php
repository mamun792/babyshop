<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarndRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\ImageManipulation;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ImageManipulation;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('web.dashboard.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarndRequest $request)
    {
        $request->validated();
        $path = $this->storeImage($request, 'photo', 'brand');
        if ($path) {
            Brand::create([
                'company' => $request->company,
                'path' => $path,
            ]);
        }

        toastr()->success('Brand Created.');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('web.dashboard.brands.edit', compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarndRequest $request, Brand $brand)
    {
        $path = $this->updateImage($request, 'photo', 'brand', $brand->path);
        if ($path) {
            $brand->update([

                'path' => $path
            ]);
        }
        $brand->update(['company' => $request->company]);

        toastr()->success('Brand Data Updated.');
        return redirect()->route('dashboard.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $exists = Product::whereBrandId( $brand->id)->exists();
        if ($exists) {
            toastr()->error('One or more product is attached to this brand, thus you can not delete this brand.');
            return back();
    
        }
        if ( $brand->delete()) {
            $this->deleteImage($brand->path);
        }


        toastr()->error('Brand Deleted.');
        return back();

    }
}
