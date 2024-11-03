<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarndRequest extends FormRequest
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
                'company' => 'required|string|max:100',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', 
            ];
       
    }

    public function messages(): array
    {
        return [
            'company.required' => 'The company name is required.',
            'company.string' => 'The company name must be a string.',
            'company.max' => 'The company name may not be greater than 100 characters.',
            'photo.image' => 'The photo must be an image file.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif.',
            'photo.max' => 'The photo may not be greater than 5120 kilobytes.',
        ];
    }
}
