<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignProductRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'campaign_id' => 'required|exists:campaigns,id'
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Product is required',
            'product_id.exists' => 'Product does not exist',
            'campaign_id.required' => 'Campaign is required',
            'campaign_id.exists' => 'Campaign does not exist',
        ];
    }
}