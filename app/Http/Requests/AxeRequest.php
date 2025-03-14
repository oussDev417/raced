<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AxeRequest extends FormRequest
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
            // 'slug' => ['required', 'string', 'max:255', 'unique:axes,slug'],
            'short_description' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => $this->axe ? ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'] : ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est requis',
            'title.string' => 'Le titre doit être une chaîne de caractères',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères',
            // 'slug.required' => 'Le slug est requis',
            // 'slug.string' => 'Le slug doit être une chaîne de caractères',
            // 'slug.max' => 'Le slug ne peut pas dépasser 255 caractères',
            // 'slug.unique' => 'Le slug doit être unique',
            'short_description.required' => 'La description courte est requise',
            'short_description.string' => 'La description courte doit être une chaîne de caractères',
            'short_description.max' => 'La description courte ne peut pas dépasser 255 caractères',
            'description.required' => 'La description est requise',
            'description.string' => 'La description doit être une chaîne de caractères',
            'image.required' => 'L\'image est requise',
            'image.image' => 'Le fichier doit être une image',
            'image.mimes' => 'L\'image doit être de type : jpeg, png, jpg, gif',
            'image.max' => 'L\'image ne peut pas dépasser 2Mo',
        ];
    }
}
