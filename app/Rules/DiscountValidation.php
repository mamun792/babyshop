<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DiscountValidation implements ValidationRule
{

    protected $discountType;

    public function __construct($discountType)
    {
        $this->discountType = $discountType;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Determine if the value is a percentage or a fixed price
        $isPercentage = str_ends_with($value, '%');
        $value = str_replace('%', '', $value); // Remove % for processing

        // Convert value to a number to handle cases where it might be a string.
        $value = floatval($value);

        if ($isPercentage) {
            // Percentage validation
            if (!is_numeric($value) || $value < 0 || $value > 100 || $value != intval($value)) {
                $fail('The discount must be an integer between 0 and 100 for percentage.');
            }
        } else {
            // Fixed price validation
            if (!is_numeric($value) || $value < 0) {
                $fail('The discount must be a non-negative number for fixed price.');
            }
        }
    }
}
