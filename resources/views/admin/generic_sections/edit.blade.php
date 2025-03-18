@extends('admin.layouts.master')

@section('title', 'Modifier une Section Générique')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.generic_sections.index') }}">Sections Génériques</a></li>
        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Modifier la Section Générique</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.generic_sections.update', $genericSection) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Contenu</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Titre</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $genericSection->title) }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Sous-titre</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $genericSection->subtitle) }}">
                                    @error('subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6">{{ old('description', $genericSection->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Médias</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format recommandé : JPG ou PNG, max 2 Mo.</small>
                                    
                                    @if($genericSection->image)
                                        <div class="mt-2" id="image-preview">
                                            <p class="mb-1">Image actuelle :</p>
                                            <img src="{{ asset('storage/' . $genericSection->image) }}" alt="{{ $genericSection->title }}" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="video_url" class="form-label">URL de la vidéo</label>
                                    <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url', $genericSection->video_url) }}">
                                    @error('video_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Ex: https://www.youtube.com/watch?v=VIDEO_ID</small>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Bouton</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="button_text" class="form-label">Texte du bouton</label>
                                            <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text', $genericSection->button_text) }}">
                                            @error('button_text')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="button_url" class="form-label">URL du bouton</label>
                                            <input type="text" class="form-control @error('button_url') is-invalid @enderror" id="button_url" name="button_url" value="{{ old('button_url', $genericSection->button_url) }}">
                                            @error('button_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Ex: /contact, https://example.com</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Publication</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', $genericSection->active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">Actif</label>
                                </div>
                                <small class="form-text text-muted">Une section inactive ne sera pas visible sur le site.</small>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Personnalisation</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="background_color" class="form-label">Couleur de fond</label>
                                    <input type="color" class="form-control form-control-color @error('background_color') is-invalid @enderror" id="background_color" name="background_color" value="{{ old('background_color', $genericSection->background_color ?: '#ffffff') }}">
                                    @error('background_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="text_color" class="form-label">Couleur du texte</label>
                                    <input type="color" class="form-control form-control-color @error('text_color') is-invalid @enderror" id="text_color" name="text_color" value="{{ old('text_color', $genericSection->text_color ?: '#000000') }}">
                                    @error('text_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h6 class="alert-heading fw-bold"><i class="fas fa-info-circle me-2"></i>Information</h6>
                            <p class="mb-0">Les sections génériques vous permettent de créer des blocs de contenu personnalisables avec texte, image, vidéo et bouton d'action.</p>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('admin.generic_sections.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Aperçu de l'image
        document.getElementById('image').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Mettre à jour l'élément d'aperçu existant
                    let preview = document.getElementById('image-preview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'image-preview';
                        preview.className = 'mt-2';
                        document.getElementById('image').parentNode.appendChild(preview);
                    }
                    preview.innerHTML = `<p class="mb-1">Nouvelle image :</p><img src="${e.target.result}" class="img-thumbnail" style="max-height: 200px;">`;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Si la description est un champ textarea avec éditeur enrichi (comme TinyMCE), initialiser ici
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '#description',
                plugins: 'link image code',
                toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | link image | code',
                height: 300
            });
        }
    });
</script>
@endpush 