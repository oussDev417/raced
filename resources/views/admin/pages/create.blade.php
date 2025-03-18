@extends('admin.layouts.master')

@section('title', 'Créer une nouvelle page')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Créer une nouvelle page</h4>
                </div>
                <div>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.pages.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Informations principales -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Informations principales</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required>
                                        <small class="text-muted">L'URL de la page sera : {{ url('/') }}/<span id="slug-preview">exemple-de-page</span></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="content" class="form-label">Contenu</label>
                                        <div class="editor-container">
                                            <div id="content-editor"></div>
                                            <input type="hidden" id="content" name="content" value="{{ old('content') }}">
                                        </div>
                                        <small class="text-muted">Ce contenu sera affiché si aucune section n'est ajoutée à la page.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">SEO</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="meta_title" class="form-label">Titre SEO</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                                        <small class="text-muted">Si vide, le titre de la page sera utilisé.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="meta_description" class="form-label">Description SEO</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="meta_keywords" class="form-label">Mots-clés SEO</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">
                                        <small class="text-muted">Séparez les mots-clés par des virgules.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Paramètres de publication -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Paramètres de publication</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Statut</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publié</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="template" class="form-label">Template</label>
                                        <select class="form-control" id="template" name="template">
                                            <option value="default" {{ old('template') == 'default' ? 'selected' : '' }}>Par défaut</option>
                                            <option value="full-width" {{ old('template') == 'full-width' ? 'selected' : '' }}>Pleine largeur</option>
                                            <option value="with-sidebar" {{ old('template') == 'with-sidebar' ? 'selected' : '' }}>Avec barre latérale</option>
                                        </select>
                                    </div>

                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="is_home" name="is_home" value="1" {{ old('is_home') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_home">Définir comme page d'accueil</label>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Créer la page</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Générer automatiquement le slug à partir du titre
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^\w\s-]/g, '') // Supprimer les caractères spéciaux
            .replace(/\s+/g, '-') // Remplacer les espaces par des tirets
            .replace(/--+/g, '-') // Éviter les tirets multiples
            .trim(); // Supprimer les espaces au début et à la fin
        
        document.getElementById('slug').value = slug;
        document.getElementById('slug-preview').textContent = slug;
    });

    // Mettre à jour l'aperçu du slug
    document.getElementById('slug').addEventListener('input', function() {
        document.getElementById('slug-preview').textContent = this.value;
    });

    // Initialiser l'éditeur Quill
    document.addEventListener('DOMContentLoaded', function() {
        const editor = initQuillEditor('#content-editor', 'Entrez le contenu de la page ici...');
        
        // Récupérer le contenu HTML lorsque le formulaire est soumis
        document.querySelector('form').addEventListener('submit', function() {
            const contentInput = document.getElementById('content');
            contentInput.value = editor.root.innerHTML;
        });
        
        // Si des données existent déjà, les charger dans l'éditeur
        const initialContent = document.getElementById('content').value;
        if (initialContent) {
            editor.root.innerHTML = initialContent;
        }
    });
</script>
@endpush 