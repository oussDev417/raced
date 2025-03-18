@extends('admin.layouts.master')

@section('title', 'Modifier un Rapport')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Rapports</a></li>
        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Modifier le Rapport</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reports.update', $report) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $report->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $report->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="publication_date" class="form-label">Date de publication</label>
                            <input type="date" class="form-control @error('publication_date') is-invalid @enderror" id="publication_date" name="publication_date" value="{{ old('publication_date', $report->publication_date ? $report->publication_date->format('Y-m-d') : '') }}">
                            @error('publication_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image de couverture</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format recommandé : JPG ou PNG, max 2 Mo.</small>
                                    
                                    @if($report->image)
                                        <div class="mt-2">
                                            <p class="mb-1">Image actuelle :</p>
                                            <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->title }}" class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pdf_file" class="form-label">Fichier PDF</label>
                                    <input type="file" class="form-control @error('pdf_file') is-invalid @enderror" id="pdf_file" name="pdf_file" accept="application/pdf">
                                    @error('pdf_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format : PDF, max 10 Mo.</small>
                                    
                                    @if($report->pdf_file)
                                        <div class="mt-2">
                                            <p class="mb-1">Fichier actuel :</p>
                                            <a href="{{ asset('storage/' . $report->pdf_file) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-file-pdf me-2"></i>Voir le fichier PDF
                                            </a>
                                        </div>
                                    @endif
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
                                    <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', $report->active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">Actif</label>
                                </div>
                                <small class="form-text text-muted">Un rapport inactif ne sera pas visible sur le site.</small>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h6 class="alert-heading fw-bold"><i class="fas fa-info-circle me-2"></i>Information</h6>
                            <p class="mb-0">Les rapports annuels, financiers ou d'activités sont des documents importants pour la transparence de l'organisation. Ils seront disponibles au téléchargement sur le site.</p>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 