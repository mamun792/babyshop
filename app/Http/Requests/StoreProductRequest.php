<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreProductRequest extends FormRequest
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
       // Log::info('StoreProductRequest' . json_encode($this->all()));
        return [
          
            'name' => 'required|string|max:255',
           
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'specifications' => 'required|string',
            'product_tag' => 'required|string|nullable',
            'option_id' => 'nullable|array',
            'option_id.*' => 'nullable|integer',
           'product_code' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|gt:price', //discount price should be greater than price
            'quantity' => 'required|nullable|integer|min:0',
            'category_id' => 'required|integer',
            'sub_category_id' => 'nullable|integer',
            'brand_id' => 'nullable|integer|exists:brands,id',
            'youtube_link' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'product_id' => 'nullable|integer',
            'product_option_id' => 'nullable|integer',
             'is_affiliate' => 'nullable|boolean',

            'product_id' => 'nullable|integer',
            'tag_id' => 'nullable|integer',

        ];
    }

    public function messages(): array
    {
        return [
            'option_id.required' => 'The option_id field is required.',
            'option_id.*.integer' => 'The option_id field must be an integer.',
            'select.required' => 'The select field is required.',
            'select.in' => 'The select field must be either "manual" or "automatic".',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price field must be a number.',
            'price.min' => 'The price field must be at least 0.',
            'discount_price.numeric' => 'The discount price field must be a number.',
            'discount_price.min' => 'The discount price field must be at least 0.',
            'discount_price.lt' => 'The discount price field must be less than the price field.',
            'quantity.integer' => 'The quantity field must be an integer.',
            'quantity.min' => 'The quantity field must be at least 0.',
            'category_id.required' => 'The category_id field is required.',
            'category_id.integer' => 'The category_id field must be an integer.',
            'category_id.exists' => 'The selected category_id is invalid, please select a valid category.',
            'sub_category_id.integer' => 'The sub_category_id field must be an integer.',
            'sub_category_id.exists' => 'The selected sub_category_id is invalid, please select a valid sub category.',
            'manual_product_code' => 'The manual product code field is required.',
            'manual_product_code.unique' => 'The manual product code has already been taken.please enter a unique code.',


        ];
    }
}
