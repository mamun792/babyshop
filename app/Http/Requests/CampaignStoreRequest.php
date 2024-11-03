<?php

namespace App\Http\Requests;

use App\Rules\DiscountValidation;
use Illuminate\Foundation\Http\FormRequest;

class CampaignStoreRequest extends FormRequest
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
        $campaignId = $this->route('id');
        return [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:start_date',
            'discount' => ['required', new DiscountValidation(request('discount'))],
            
            'code' => $campaignId
            ? 'nullable|unique:campaigns,code,' . $campaignId
            : 'nullable|unique:campaigns,code',
        ];
    }

        public function messages()
    {
        return [
            'name.required' => 'The campaign name field is required.',
            'start_date.required' => 'The start date field is required.',
            'expiry_date.required' => 'The expiry date field is required.',
        ];
    }
    
}
