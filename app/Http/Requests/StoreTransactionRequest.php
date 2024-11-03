<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'account_id' => 'required|exists:accounts,id',
            'purpose_id' => 'required|exists:purposes,id',
            'transaction_type' => 'required|in:credit,debit',
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'invoice' => 'nullable|string',
            'comments' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
}
