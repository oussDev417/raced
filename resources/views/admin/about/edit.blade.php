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
                            <input type="hidden" name="description" id="description_input">
                            <div id="description_editor" class="editor-container @error('description') is-invalid @enderror">
                                {!! old('description', $about->description) !!}
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mission" class="form-label">Notre mission</label>
                            <input type="hidden" name="mission" id="mission_input">
                            <div id="mission_editor" class="editor-container @error('mission') is-invalid @enderror">
                                {!! old('mission', $about->mission) !!}
                            </div>
                            @error('mission')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="vision" class="form-label">Notre vision</label>
                            <input type="hidden" name="vision" id="vision_input">
                            <div id="vision_editor" class="editor-container @error('vision') is-invalid @enderror">
                                {!! old('vision', $about->vision) !!}
                            </div>
                            @error('vision')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="values" class="form-label">Nos valeurs</label>
                            <input type="hidden" name="values" id="values_input">
                            <div id="values_editor" class="editor-container @error('values') is-invalid @enderror">
                                {!! old('values', $about->values) !!}
                            </div>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des éditeurs Quill
    const descriptionEditor = initQuillEditor('#description_editor', 'Entrez la description détaillée...');
    const missionEditor = initQuillEditor('#mission_editor', 'Entrez la mission...');
    const visionEditor = initQuillEditor('#vision_editor', 'Entrez la vision...');
    const valuesEditor = initQuillEditor('#values_editor', 'Entrez les valeurs...');

    // Mise à jour des champs cachés avant la soumission du formulaire
    document.getElementById('aboutForm').addEventListener('submit', function() {
        document.getElementById('description_input').value = descriptionEditor.root.innerHTML;
        document.getElementById('mission_input').value = missionEditor.root.innerHTML;
        document.getElementById('vision_input').value = visionEditor.root.innerHTML;
        document.getElementById('values_input').value = valuesEditor.root.innerHTML;
    });

    // Prévisualisation de l'image principale
    const mainImageInput = document.getElementById('main_image');
    const mainPreviewImage = document.getElementById('preview');

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

    // Prévisualisation de l'image secondaire
    const secondaryImageInput = document.getElementById('secondary_image');
    const secondaryPreviewImage = document.getElementById('preview2');

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
});
</script>
@endsection