<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
           'name' => 'required|string|max:50',
            'phone' => 'required|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email|unique:users,email',
            'country' => 'required|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'address' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name may not be greater than 50 characters',

            'phone.required' => 'Phone number is required',
            'phone.string' => 'Phone number must be a string',
            'phone.max' => 'Phone number may not be greater than 15 characters',
            'phone.regex' => 'Phone number format is invalid',

            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email is already taken',

            'country.required' => 'Country is required',
            'country.string' => 'Country must be a string',

            'state.string' => 'State must be a string',

            'city.string' => 'City must be a string',

            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string',
            'address.max' => 'Address may not be greater than 255 characters',

        ];
    }
}
