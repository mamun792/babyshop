<?php

namespace App\Http\Requests;

use App\Rules\UniqueInvoiceNumber;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductPurchaseRequest extends FormRequest
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
            'purchase_name' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'invoice_number' => ['required', 'string', 'max:255', new UniqueInvoiceNumber],
            'supplier_id' => 'required|exists:suppliers,id',
            'document' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            // 'product_code' => 'required|string|max:255',
            // 'price' => 'required|numeric|min:0',
            // 'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string',
        ];
    }
}
