<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|string|max:50|unique:coupons,code',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_amount' => 'required|numeric|min:0',
            'valid_from' => 'required|date|before_or_equal:expiry_date',
            'expiry_date' => 'required|date|after:valid_from',
            'usage_limit' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'The coupon code is required.',
            'code.string' => 'The coupon code must be a string.',
            'code.max' => 'The coupon code may not be greater than 50 characters.',
            'code.unique' => 'The coupon code has already been taken.',
            'discount_type.required' => 'The discount type is required.',
            'discount_type.in' => 'The discount type must be either "fixed" or "percentage".',
            'discount_amount.required' => 'The discount amount is required.',
            'discount_amount.numeric' => 'The discount amount must be a number.',
            'discount_amount.min' => 'The discount amount must be at least 0.',
            'valid_from.required' => 'The valid from date is required.',
            'valid_from.date' => 'The valid from date must be a valid date.',
            'valid_from.before_or_equal' => 'The valid from date must be before or equal to the expiry date.',
            'expiry_date.required' => 'The expiry date is required.',
            'expiry_date.date' => 'The expiry date must be a valid date.',
            'expiry_date.after' => 'The expiry date must be after the valid from date.',
            'usage_limit.required' => 'The usage limit is required.',
            'usage_limit.integer' => 'The usage limit must be an integer.',
            'usage_limit.min' => 'The usage limit must be at least 1.',
        ];
    }
}
