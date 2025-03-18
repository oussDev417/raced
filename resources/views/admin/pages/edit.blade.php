@extends('admin.layouts.master')

@section('title', 'Modifier la page')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Modifier la page : {{ $page->title }}</h4>
                </div>
                <div>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.pages.update', $page) }}" method="POST">
                    @csrf
                    @method('PUT')
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
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $page->title) }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $page->slug) }}" required>
                                        <small class="text-muted">L'URL de la page sera : {{ url('/') }}/<span id="slug-preview">{{ $page->slug }}</span></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="content" class="form-label">Contenu</label>
                                        <textarea class="form-control" id="content" name="content" rows="5">{{ old('content', $page->content) }}</textarea>
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
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}">
                                        <small class="text-muted">Si vide, le titre de la page sera utilisé.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="meta_description" class="form-label">Description SEO</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $page->meta_description) }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="meta_keywords" class="form-label">Mots-clés SEO</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}">
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
                                            <option value="draft" {{ old('status', $page->status) == 'draft' ? 'selected' : '' }}>Brouillon</option>
                                            <option value="published" {{ old('status', $page->status) == 'published' ? 'selected' : '' }}>Publié</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="template" class="form-label">Template</label>
                                        <select class="form-control" id="template" name="template">
                                            <option value="default" {{ old('template', $page->template) == 'default' ? 'selected' : '' }}>Par défaut</option>
                                            <option value="full-width" {{ old('template', $page->template) == 'full-width' ? 'selected' : '' }}>Pleine largeur</option>
                                            <option value="with-sidebar" {{ old('template', $page->template) == 'with-sidebar' ? 'selected' : '' }}>Avec barre latérale</option>
                                        </select>
                                    </div>

                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="is_home" name="is_home" value="1" {{ old('is_home', $page->is_home) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_home">Définir comme page d'accueil</label>
                                    </div>

                                    <div class="d-grid gap-2 mb-3">
                                        <button type="submit" class="btn btn-primary">Mettre à jour la page</button>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.page_sections.index', $page) }}" class="btn btn-info">
                                            <i class="fa fa-list me-2"></i>Gérer les sections
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations supplémentaires -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Informations</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Créé le :</strong> {{ $page->created_at->format('d/m/Y à H:i') }}</p>
                                    <p><strong>Dernière modification :</strong> {{ $page->updated_at->format('d/m/Y à H:i') }}</p>
                                    <p><strong>Nombre de sections :</strong> {{ $page->pageSections->count() }}</p>
                                    
                                    <div class="d-grid gap-2 mt-3">
                                        <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-sm btn-success">
                                            <i class="fa fa-eye me-2"></i>Voir la page
                                        </a>
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

    // Initialiser l'éditeur WYSIWYG si disponible
    if (typeof ClassicEditor !== 'undefined') {
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    }
</script>
@endpush 