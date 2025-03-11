@extends('admin.layouts.master')

@section('title', 'Modifier un Partenaire')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partenaires</a></li>
        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Modifier un Partenaire</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nom du partenaire <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $partner->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website" class="form-label">Site Web</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website', $partner->website) }}" placeholder="https://exemple.com">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Optionnel. Incluez le protocole (http:// ou https://)</small>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $partner->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Optionnel. Une brève description du partenaire.</small>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format recommandé : PNG ou JPG, taille maximale : 2 Mo. Laissez vide pour conserver le logo actuel.</small>
                        </div>
                        
                        <div class="mt-3" id="current-logo">
                            <p>Logo actuel :</p>
                            @if($partner->logo)
                                <img src="{{ asset($partner->logo) }}" alt="{{ $partner->name }}" class="img-thumbnail" style="max-height: 150px;">
                            @else
                                <div class="alert alert-info">Aucun logo n'a été défini.</div>
                            @endif
                        </div>
                        
                        <div class="mt-3" id="logo-preview-container" style="display: none;">
                            <p>Nouveau logo :</p>
                            <img id="logo-preview" src="#" alt="Aperçu du nouveau logo" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Enregistrer les modifications
                        </button>
                        <a href="{{ route('partners.index') }}" class="btn btn-secondary">
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
    // Prévisualisation du logo
    const logoInput = document.getElementById('logo');
    const logoPreview = document.getElementById('logo-preview');
    const logoPreviewContainer = document.getElementById('logo-preview-container');
    
    logoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                logoPreview.src = e.target.result;
                logoPreviewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(this.files[0]);
        } else {
            logoPreviewContainer.style.display = 'none';
        }
    });
});
</script>
@endsection 