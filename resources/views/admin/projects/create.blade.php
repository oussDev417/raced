@extends('admin.layouts.master')

@section('title', 'Ajouter un projet')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projets</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Ajouter un projet</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" id="projectForm">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                    id="slug" name="slug" value="{{ old('slug') }}" required>
                                <button class="btn btn-outline-secondary" type="button" id="regenerateSlug">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">L'identifiant unique du projet dans l'URL (généré automatiquement à partir du titre).</small>
                        </div>

                        <div class="mb-3">
                            <label for="short_description" class="form-label">Description courte <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                id="short_description" name="short_description" rows="3" required>{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Une brève description qui apparaîtra dans la liste des projets.</small>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description détaillée <span class="text-danger">*</span></label>
                            <input type="hidden" name="description" id="description_input">
                            <div id="description_editor" class="editor-container @error('description') is-invalid @enderror">
                                {!! old('description') !!}
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                id="image" name="image" accept="image/*" required>
                            <small class="form-text text-muted">Format accepté : JPG, PNG, GIF. Taille maximale : 2 Mo.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="image-preview" style="max-width: 200px;">
                                <img id="preview" src="#" alt="Aperçu de l'image" style="max-width: 100%; display: none;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Enregistrer
                        </button>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation de l'éditeur Quill pour la description détaillée
    const descriptionEditor = initQuillEditor('#description_editor', 'Entrez la description détaillée...');
    
    // Mise à jour du champ caché avant la soumission du formulaire
    document.getElementById('projectForm').addEventListener('submit', function() {
        document.getElementById('description_input').value = descriptionEditor.root.innerHTML;
    });

    // Prévisualisation de l'image
    const imageInput = document.getElementById('image');
    const previewImage = document.getElementById('preview');

    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
    // Génération automatique du slug
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const regenerateButton = document.getElementById('regenerateSlug');

    function generateSlug(text) {
        return text
            .toString()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w-]+/g, '')
            .replace(/--+/g, '-');
    }

    titleInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.value === generateSlug(titleInput.value.trim())) {
            slugInput.value = generateSlug(this.value);
        }
    });

    regenerateButton.addEventListener('click', function() {
        slugInput.value = generateSlug(titleInput.value);
    });
});
</script>
@endsection 