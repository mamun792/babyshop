<?php

namespace App\Http\Requests;

use App\Rules\ImageDimensions;
use Illuminate\Foundation\Http\FormRequest;

class StoreHeroSliderRequest extends FormRequest
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
            'banner_slider' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,jpeg,webp',
                'max:5120',
                //   new ImageDimensions(1000, 430), // Custom dimension rule
            ],
           //'hero_slider' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',

        ];
        
    }

    public function messages(): array
    {
        return [
            'banner_slider.required' => 'Banner Slider is required',
            'banner_slider.image' => 'Banner Slider must be an image',
            'banner_slider.mimes' => 'Banner Slider must be a file of type: jpeg, png, jpg, gif',
            'banner_slider.max' => 'Banner Slider must be a file of type: jpeg, png, jpg, gif and max size 5120',

        ];
    }
}
