<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ImageDimensions implements ValidationRule
{
    protected $width;
    protected $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the file is an uploaded file and if it's a valid image
        if ($value->isValid() && in_array($value->getMimeType(), ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])) {
            // Get the image dimensions
            [$width, $height] = getimagesize($value);

            // Validate image dimensions
            if ($width !== $this->width || $height !== $this->height) {
                $fail("The :attribute must have dimensions of exactly {$this->width}x{$this->height} pixels.");
            }
        } else {
            $fail("The :attribute must be a valid image file.");
        }
    }
}