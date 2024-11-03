<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:5000',
            'specifications' => 'nullable|string|max:5000',
            'product_tag' => 'nullable|array',
            'product_tag.*' => 'integer',
            'option_id' => 'nullable|array',
            'option_id.*' => 'integer',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'coupon_id' => 'nullable|integer',
            'discount_price' => 'nullable|numeric|min:0',
            //'discount_type' => 'nullable|string',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'youtube_link' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_image_three' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'product_code.required' => 'The product code is required.',
            'price.required' => 'The product price is required.',
            'quantity.required' => 'The product quantity is required.',
            'category_id.required' => 'The category ID is required.',
            'sub_category_id.required' => 'The sub-category ID is required.',
            'brand_id.required' => 'The brand ID is required.',
            'product_tag.*.integer' => 'Each product tag must be a valid integer.',
            'product_tag.*.exists' => 'Each selected product tag must exist in the database.',
            'option_id.*.integer' => 'Each option ID must be a valid integer.',
            'option_id.*.exists' => 'Each selected option ID must exist in the database.',
        ];
    }
}
