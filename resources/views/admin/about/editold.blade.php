@extends('admin.layouts.master')

@section('title', 'Modifier la page À propos')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">À propos</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Modifier la page À propos</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" id="aboutForm">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title', $about->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Sous-titre</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" 
                                id="subtitle" name="subtitle" value="{{ old('subtitle', $about->subtitle) }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="short_description" class="form-label">Description courte <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                id="short_description" name="short_description" rows="3" required>{{ old('short_description', $about->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Un bref résumé qui apparaîtra en haut de la page.</small>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description détaillée <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control">{!! old('description', $about->description) !!}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mission" class="form-label">Notre mission</label>
                            <textarea name="mission" id="mission" class="form-control">{!! old('mission', $about->mission) !!}</textarea>
                            @error('mission')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="vision" class="form-label">Notre vision</label>
                            <textarea name="vision" id="vision" class="form-control">{!! old('vision', $about->vision) !!}</textarea>
                            @error('vision')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="values" class="form-label">Nos valeurs</label>
                            <textarea name="values" id="values" class="form-control">{!! old('values', $about->values) !!}</textarea>
                            @error('values')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="main_image" class="form-label">Image principale</label>
                            <input type="file" class="form-control @error('main_image') is-invalid @enderror" 
                                id="main_image" name="main_image" accept="image/*">
                            <small class="form-text text-muted">Format accepté : JPG, PNG, GIF. Taille maximale : 2 Mo.</small>
                            @error('main_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="image-preview" style="max-width: 200px;">
                                @if($about->main_image)
                                    <img id="preview" src="{{ asset($about->main_image) }}" 
                                         alt="Image principale" 
                                         style="max-width: 100%;">
                                @else
                                    <img id="preview" src="#" 
                                         alt="Aperçu de l'image" 
                                         style="max-width: 100%; display: none;">
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="secondary_image" class="form-label">Image secondaire</label>
                            <input type="file" class="form-control @error('secondary_image') is-invalid @enderror" 
                                id="secondary_image" name="secondary_image" accept="image/*">
                            <small class="form-text text-muted">Format accepté : JPG, PNG, GIF. Taille maximale : 2 Mo.</small>
                            @error('secondary_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="image-preview" style="max-width: 200px;">
                                @if($about->secondary_image)
                                    <img id="preview2" src="{{ asset($about->secondary_image) }}" 
                                         alt="Image secondaire" 
                                         style="max-width: 100%;">
                                @else
                                    <img id="preview2" src="#" 
                                         alt="Aperçu de l'image" 
                                         style="max-width: 100%; display: none;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('editor_scripts')
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editorConfig = {
        height: '300px',
        language: 'fr',
        toolbar: [
            ['Source'],
            ['Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo'],
            ['Find', 'Replace'],
            '/',
            ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Link', 'Unlink'],
            ['Image', 'Table', 'HorizontalRule', 'SpecialChar'],
            '/',
            ['Styles', 'Format', 'Font', 'FontSize'],
            ['TextColor', 'BGColor'],
            ['Maximize', 'ShowBlocks']
        ],
        removePlugins: 'elementspath',
        allowedContent: true,
        entities: false
    };

    // Initialisation des éditeurs
    ['description', 'mission', 'vision', 'values'].forEach(function(fieldId) {
        if (document.getElementById(fieldId)) {
            CKEDITOR.replace(fieldId, editorConfig);
        }
    });

    // Code de prévisualisation des images
    const mainImageInput = document.getElementById('main_image');
    const mainPreviewImage = document.getElementById('preview');
    if (mainImageInput && mainPreviewImage) {
        mainImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    mainPreviewImage.src = e.target.result;
                    mainPreviewImage.style.display = 'block';
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    const secondaryImageInput = document.getElementById('secondary_image');
    const secondaryPreviewImage = document.getElementById('preview2');
    if (secondaryImageInput && secondaryPreviewImage) {
        secondaryImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    secondaryPreviewImage.src = e.target.result;
                    secondaryPreviewImage.style.display = 'block';
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});
</script>
@endsection

@section('styles')
<style>
    .cke_chrome {
        border: 1px solid #ddd !important;
        border-radius: 4px !important;
        margin-bottom: 1rem !important;
    }
    .cke_top {
        background: #f8f9fa !important;
        border-bottom: 1px solid #ddd !important;
        padding: 8px !important;
    }
    .cke_bottom {
        background: #f8f9fa !important;
        border-top: 1px solid #ddd !important;
    }
    .cke_contents {
        padding: 10px !important;
    }
</style>
@endsection