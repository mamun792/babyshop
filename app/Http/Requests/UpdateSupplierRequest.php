<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'supplier_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_phone' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'company_address' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_name.required' => 'The supplier name field is required.',
            'company_name.required' => 'The company name field is required.',
            'company_phone.required' => 'The company phone field is required.',
            'company_phone.regex' => 'The company phone field is invalid.',
            'company_address.required' => 'The company address field is required.',
            'company_name.string' => 'The company name must be a string.',
            'company_address.required' => 'The company address field is required.',
        ];
    }
}
