<?php

namespace App\Http\Requests;

use App\Rules\ImageDimensions;
use Illuminate\Foundation\Http\FormRequest;

class StoreBannerSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'banner_sliders' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,jpeg,webp',
                //  new ImageDimensions(400, 200)
  
            ],
        ];
    }

    public function messages(): array
    {
       
            return [
                'banner_sliders.required' => 'Banner Slider is required',
                'banner_sliders.image' => 'Banner Slider must be an image',
                'banner_sliders.mimes' => 'Banner Slider must be a file of type: jpeg, png, jpg, gif',
                 'banner_slider.max' => 'Banner Slider must be a file of type: jpeg, png, jpg, gif and max size 5120',
    
            ];
       
    }
}
