<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\StoreBannerSliderRequest;
use App\Http\Requests\StoreHeroSliderRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Traits\ImageManipulation;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use ImageManipulation;

    public function index()
    {
        //
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
    public function store(UpdateBannerRequest $request)
    {
        $validated = $request->validated();
        $path= $this->storeImage($request,'banner_slider','hero_slider');
        Banner::create(
                ['image_path' => $path],
                
            );
            toastr()->success('Slider Image Uploaded.');

            return back();
    }

    public function storeSliders(StoreBannerSliderRequest $request)
    {
        $validated = $request->validated();
        $path = $this->storeImage($request, 'banner_sliders', 'hero_slider');
        $type="slide2";
        Banner::create(
            ['image_path' => $path,
            'type'=>$type
        ],
            
        );

        toastr()->success('Slider Image Uploaded.');

        return back();

    }

    public function storeSlider(UpdateBannerRequest $request)
    {
        
        $validated = $request->validated();
       $path = $this->storeImage($request, 'banner_slider', 'hero_slider');
        $type="slide2";
        Banner::create(
            ['image_path' => $path,
            'type'=>$type
        ],
            
        );

        toastr()->success('Slider Image Uploaded.');

        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banner=Banner::find($id);
        if ( $this->deleteImage($banner->image_path)) {
            $banner->delete();
        }
        toastr()->error('Slider Image Deleted.');
        return back();
    }

    public function DeleteSlider($id){
        $banner=Banner::find($id);
        if ( $this->deleteImage($banner->image_path)) {
            $banner->delete();
        }
        toastr()->error('Slider Image Deleted.');
        return back();
    }
}
