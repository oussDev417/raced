<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GalerieCategoryRequest extends FormRequest
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
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => 'nullable|string|max:1000',
        ];

        // Si c'est une mise à jour, ajouter une règle unique qui exclut l'enregistrement actuel
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $categoryId = $this->route('category');
            $rules['name'][] = Rule::unique('galerie_categories')->ignore($categoryId);
        } else {
            // Si c'est une création, vérifier simplement que le nom est unique
            $rules['name'][] = 'unique:galerie_categories,name';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la catégorie est obligatoire.',
            'name.max' => 'Le nom de la catégorie ne doit pas dépasser 255 caractères.',
            'name.unique' => 'Ce nom de catégorie existe déjà.',
            'description.max' => 'La description ne doit pas dépasser 1000 caractères.',
        ];
    }
} 