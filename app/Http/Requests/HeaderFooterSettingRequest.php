<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeaderFooterSettingRequest extends FormRequest
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
            'horaire_admin' => ['nullable', 'string'],
            'horaire_anim' => ['nullable', 'string'],
            'adresse' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'fb_link' => ['nullable', 'string', 'max:255', 'url'],
            'insta_link' => ['nullable', 'string', 'max:255', 'url'],
            'linkedin_link' => ['nullable', 'string', 'max:255', 'url'],
            'youtube_link' => ['nullable', 'string', 'max:255', 'url'],
        ];
    }

    public function messages(): array
    {
        return [
            'horaire_admin.string' => 'L\'horaire administratif doit être une chaîne de caractères',
            'horaire_anim.string' => 'L\'horaire d\'animation doit être une chaîne de caractères',
            'adresse.required' => 'L\'adresse est requise',
            'adresse.string' => 'L\'adresse doit être une chaîne de caractères',
            'adresse.max' => 'L\'adresse ne peut pas dépasser 255 caractères',
            'email.required' => 'L\'email est requis',
            'email.string' => 'L\'email doit être une chaîne de caractères',
            'email.email' => 'L\'email doit être une adresse email valide',
            'email.max' => 'L\'email ne peut pas dépasser 255 caractères',
            'phone.required' => 'Le téléphone est requis',
            'phone.string' => 'Le téléphone doit être une chaîne de caractères',
            'phone.max' => 'Le téléphone ne peut pas dépasser 20 caractères',
            'fb_link.string' => 'Le lien Facebook doit être une chaîne de caractères',
            'fb_link.max' => 'Le lien Facebook ne peut pas dépasser 255 caractères',
            'fb_link.url' => 'Le lien Facebook doit être une URL valide',
            'insta_link.string' => 'Le lien Instagram doit être une chaîne de caractères',
            'insta_link.max' => 'Le lien Instagram ne peut pas dépasser 255 caractères',
            'insta_link.url' => 'Le lien Instagram doit être une URL valide',
            'linkedin_link.string' => 'Le lien LinkedIn doit être une chaîne de caractères',
            'linkedin_link.max' => 'Le lien LinkedIn ne peut pas dépasser 255 caractères',
            'linkedin_link.url' => 'Le lien LinkedIn doit être une URL valide',
            'youtube_link.string' => 'Le lien YouTube doit être une chaîne de caractères',
            'youtube_link.max' => 'Le lien YouTube ne peut pas dépasser 255 caractères',
            'youtube_link.url' => 'Le lien YouTube doit être une URL valide',
        ];
    }
}
