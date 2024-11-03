<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartManagementRequest extends FormRequest
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
            'productId' => 'required',
            'quantity' => 'required|integer|min:1',
            'userId' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'productId.required' => 'Product ID is required',
          
           
            'quantity.required' => 'Quantity is required',
            'quantity.integer' => 'Quantity must be an integer',
            'quantity.min' => 'Quantity must be at least 1',
            'userId.required' => 'User ID is required',
          
            'userId.integer' => 'User ID must be an integer',
        ];
    }
}
