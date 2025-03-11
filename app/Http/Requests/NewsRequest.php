<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
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
            'news_category_id' => ['required', 'exists:news_categories,id'],
            'thumbnail' => $this->news ? ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'] : ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('news')->ignore($this->news)],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'news_category_id.required' => 'La catégorie est requise',
            'news_category_id.exists' => 'La catégorie sélectionnée n\'existe pas',
            'thumbnail.required' => 'L\'image miniature est requise',
            'thumbnail.image' => 'Le fichier doit être une image',
            'thumbnail.mimes' => 'L\'image doit être de type : jpeg, png, jpg, gif',
            'thumbnail.max' => 'L\'image ne peut pas dépasser 2Mo',
            'title.required' => 'Le titre est requis',
            'title.string' => 'Le titre doit être une chaîne de caractères',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères',
            'slug.required' => 'Le slug est requis',
            'slug.string' => 'Le slug doit être une chaîne de caractères',
            'slug.max' => 'Le slug ne peut pas dépasser 255 caractères',
            'slug.unique' => 'Ce slug est déjà utilisé',
            'short_description.required' => 'La description courte est requise',
            'short_description.string' => 'La description courte doit être une chaîne de caractères',
            'description.required' => 'La description est requise',
            'description.string' => 'La description doit être une chaîne de caractères',
        ];
    }
}
