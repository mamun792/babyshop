<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{
    /**
     * Generate a unique slug for a given model.
     *
     * @param string $name
     * @param string $model
     * @return string
     */
    public function createSlug(string $name, string $model): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

       
        while ($model::where('slug', $slug)->exists()) {
            // Append a counter to the slug if it already exists
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }
}
