<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
           'name' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|integer',
            'sub_category_id' => 'nullable|integer',
          //  'brand_id' => 'nullable|integer',
            'discount_price' => 'nullable|numeric|min:0',
            //'discount_type' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_three' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'youtube_link' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'specifications' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'option_id' => 'nullable|array',
            'option_id.*' => 'integer|exists:options,id',
            'product_tag' => 'nullable|array',
            'product_tag.*' => 'string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'product_code.required' => 'The product code is required.',
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The product price must be a number.',
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'The quantity must be an integer.',
            'quantity.min' => 'The quantity must be at least 1.',
        ];
    }
}
