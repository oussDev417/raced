<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatFactRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'counter' => ['required', 'string', 'max:255'],
            'counter_after' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est requis',
            'title.string' => 'Le titre doit être une chaîne de caractères',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères',
            'counter.required' => 'Le compteur est requis',
            'counter.string' => 'Le compteur doit être une chaîne de caractères',
            'counter.max' => 'Le compteur ne peut pas dépasser 255 caractères',
            'counter_after.string' => 'Le texte après le compteur doit être une chaîne de caractères',
            'counter_after.max' => 'Le texte après le compteur ne peut pas dépasser 255 caractères',
        ];
    }
}
