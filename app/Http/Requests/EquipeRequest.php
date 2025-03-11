<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipeRequest extends FormRequest
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
            'equipe_category_id' => ['required', 'exists:equipe_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'image' => $this->equipe ? ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'] : ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'equipe_category_id.required' => 'La catégorie est requise',
            'equipe_category_id.exists' => 'La catégorie sélectionnée n\'existe pas',
            'name.required' => 'Le nom est requis',
            'name.string' => 'Le nom doit être une chaîne de caractères',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères',
            'position.required' => 'Le poste est requis',
            'position.string' => 'Le poste doit être une chaîne de caractères',
            'position.max' => 'Le poste ne peut pas dépasser 255 caractères',
            'phone.string' => 'Le téléphone doit être une chaîne de caractères',
            'phone.max' => 'Le téléphone ne peut pas dépasser 20 caractères',
            'email.string' => 'L\'email doit être une chaîne de caractères',
            'email.email' => 'L\'email doit être une adresse email valide',
            'email.max' => 'L\'email ne peut pas dépasser 255 caractères',
            'image.required' => 'L\'image est requise',
            'image.image' => 'Le fichier doit être une image',
            'image.mimes' => 'L\'image doit être de type : jpeg, png, jpg, gif',
            'image.max' => 'L\'image ne peut pas dépasser 2Mo',
        ];
    }
}
