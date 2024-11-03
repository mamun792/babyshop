<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaUploadRequest extends FormRequest
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
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg|max:1024',
            'loader' => 'nullable|image|mimes:gif,png,jpg,jpeg|max:2048',
            'footer_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'other_images.*' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
