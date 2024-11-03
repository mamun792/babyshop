<?php

namespace App\Http\Requests;

use App\Models\Purchase;
use App\Rules\UniqueInvoiceNumber;
use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
           
            'comment' => 'nullable|string'
        ];

       

    }

    public function messages(): array
    {
        return [
            'product.required' => 'Product name is required',
            'purchase_date.required' => 'Purchase date is required',
            'invoice_number.required' => 'Invoice number is required',
            'supplier_id.required' => 'Supplier is required',
            'document.required' => 'Document is required',
            'document.mimes' => 'Document must be a file of type: jpeg, png, jpg, pdf',
            'document.max' => 'Document must not be greater than 2MB',
            'comment.required' => 'Comment is required',
            'invoice_number.unique' => 'Invoice number already exists', 
          
        ];
    }
}
