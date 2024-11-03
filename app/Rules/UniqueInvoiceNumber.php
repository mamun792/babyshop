<?php

namespace App\Rules;

use App\Models\Purchase;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueInvoiceNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
              // Check if the invoice number already exists in the purchases table

              if (Purchase::where('invoice_number', $value)->exists()) {
                // Fail the validation if the invoice number is not unique
                $fail('The invoice number has already been taken. Please enter a unique invoice number.');
            }

    }
}
