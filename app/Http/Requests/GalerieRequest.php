<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalerieRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'nullable|exists:galerie_categories,id',
        ];

        // Si c'est une création, l'image est obligatoire
        if ($this->isMethod('POST')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:5120'; // 5MB max
        } else {
            // Si c'est une mise à jour, l'image est optionnelle
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'; // 5MB max
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
            'title.required' => 'Le titre de l\'image est obligatoire.',
            'title.max' => 'Le titre de l\'image ne doit pas dépasser 255 caractères.',
            'description.max' => 'La description ne doit pas dépasser 1000 caractères.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'image.required' => 'Vous devez sélectionner une image.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format JPEG, PNG, JPG ou GIF.',
            'image.max' => 'L\'image ne doit pas dépasser 5 Mo.',
        ];
    }
}
