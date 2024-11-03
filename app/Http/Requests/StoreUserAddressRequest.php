<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserAddressRequest extends FormRequest
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
           
            'full_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:12',
           
            'area' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'label' => 'required|string|in:Home,Office',
            'is_default_delivery' => 'nullable|boolean',
            'is_default_billing' => 'nullable|boolean',
          
        ];
    }

    public function messages(): array
    {
        return [
            // 'user_id.required' => 'User ID is required',
            // 'user_id.exists' => 'User ID does not exist',
            'full_name.required' => 'Full name is required',
            'full_name.string' => 'Full name must be a string',
            'full_name.max' => 'Full name must not exceed 255 characters',
            'mobile_number.required' => 'Mobile number is required',
            'mobile_number.string' => 'Mobile number must be a string',
            'mobile_number.max' => 'Mobile number must not exceed 11 characters',
            
            'area.required' => 'Area is required',
            'area.string' => 'Area must be a string',
            'area.max' => 'Area must not exceed 255 characters',
            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string',
            'address.max' => 'Address must not exceed 255 characters',
            'landmark.string' => 'Landmark must be a string',
            'landmark.max' => 'Landmark must not exceed 255 characters',

            'label.required' => 'Label is required',
            'label.string' => 'Label must be a string',
            'label.in' => 'Label must be either Home or Office',
            'is_default_delivery.boolean' => 'Default delivery must be a boolean',
            'is_default_billing.boolean' => 'Default billing must be a boolean',
        ];
    }
}
