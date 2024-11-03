<?php

namespace App\Http\Controllers;

use App\Models\HeroSlider;
use App\Http\Requests\StoreHeroSliderRequest;
// use App\Http\Requests\UpdateHeroSliderRequest;

use App\Models\Banner;
use App\Traits\ImageManipulation;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrInterface;

class HeroSliderController extends Controller
{
    use ImageManipulation;
   
    public function index()
    {
        $data = HeroSlider::all();
   
        return view('web.dashboard.hero.index',compact('data'));
    }


    public function store(StoreHeroSliderRequest $request)
    {
    
        $request->validated();
        
       
       $path = $this->storeImage($request,'banner_slider','hero_slider');
       
       HeroSlider::create(
        ['image_path' => $path]
       );
       
        toastr()->success('Slider Image Uploaded.');
        

        return back();

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSlider $heroSlider)
    {
    
        if ( $this->deleteImage($heroSlider->image_path)) {
            $heroSlider->delete();
        }
        toastr()->error('Slider Image Deleted.');
        return back();
    }

    public function show()
    {
        $slider=Banner::all();
        return view('web.dashboard.hero.show',compact('slider'));
    }

   
}
