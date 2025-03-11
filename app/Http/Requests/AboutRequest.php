<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'values' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'secondary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'subtitle.max' => 'Le sous-titre ne doit pas dépasser 255 caractères.',
            'short_description.required' => 'La description courte est obligatoire.',
            'short_description.max' => 'La description courte ne doit pas dépasser 500 caractères.',
            'description.required' => 'La description détaillée est obligatoire.',
            'main_image.image' => 'Le fichier doit être une image.',
            'main_image.mimes' => 'L\'image doit être de type : jpeg, png, jpg, gif.',
            'main_image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
            'secondary_image.image' => 'Le fichier doit être une image.',
            'secondary_image.mimes' => 'L\'image doit être de type : jpeg, png, jpg, gif.',
            'secondary_image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}
