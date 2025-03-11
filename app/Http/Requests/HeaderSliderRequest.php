<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeaderSliderRequest extends FormRequest
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
            'image' => $this->header_slider ? ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'] : ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'btn1_text' => ['nullable', 'string', 'max:255'],
            'btn1_url' => ['nullable', 'string', 'max:255', 'url'],
            'btn2_text' => ['nullable', 'string', 'max:255'],
            'btn2_url' => ['nullable', 'string', 'max:255', 'url'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'L\'image est requise',
            'image.image' => 'Le fichier doit être une image',
            'image.mimes' => 'L\'image doit être de type : jpeg, png, jpg, gif',
            'image.max' => 'L\'image ne peut pas dépasser 2Mo',
            'title.required' => 'Le titre est requis',
            'title.string' => 'Le titre doit être une chaîne de caractères',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères',
            'subtitle.string' => 'Le sous-titre doit être une chaîne de caractères',
            'subtitle.max' => 'Le sous-titre ne peut pas dépasser 255 caractères',
            'description.string' => 'La description doit être une chaîne de caractères',
            'btn1_text.string' => 'Le texte du bouton 1 doit être une chaîne de caractères',
            'btn1_text.max' => 'Le texte du bouton 1 ne peut pas dépasser 255 caractères',
            'btn1_url.string' => 'L\'URL du bouton 1 doit être une chaîne de caractères',
            'btn1_url.max' => 'L\'URL du bouton 1 ne peut pas dépasser 255 caractères',
            'btn1_url.url' => 'L\'URL du bouton 1 doit être une URL valide',
            'btn2_text.string' => 'Le texte du bouton 2 doit être une chaîne de caractères',
            'btn2_text.max' => 'Le texte du bouton 2 ne peut pas dépasser 255 caractères',
            'btn2_url.string' => 'L\'URL du bouton 2 doit être une chaîne de caractères',
            'btn2_url.max' => 'L\'URL du bouton 2 ne peut pas dépasser 255 caractères',
            'btn2_url.url' => 'L\'URL du bouton 2 doit être une URL valide',
        ];
    }
}
