<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAddressRequest extends FormRequest
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
            'id' => 'required|integer' ,
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'area' => 'required|string|max:100|in:Dhaka,Chattogram,Rajshahi,Khulna,Barishal,Sylhet,Rangpur,Mymensingh',
            'address' => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'label' => 'required|string|in:Home,Office',
            'is_default_billing' => 'nullable|boolean',
            'is_default_delivery' => 'nullable|boolean',
        ];
    }
}
