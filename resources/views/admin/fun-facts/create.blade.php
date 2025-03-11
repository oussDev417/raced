@extends('admin.layouts.master')

@section('title', 'Ajouter un Fun Fact')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.fun-facts.index') }}">Fun Facts</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Ajouter un Fun Fact</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.fun-facts.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Exemple : Bénévoles actifs</small>
                        </div>

                        <div class="mb-3">
                            <label for="count" class="form-label">Compteur <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('count') is-invalid @enderror" id="count" name="count" value="{{ old('count') }}" required min="0">
                            @error('count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Exemple : 150</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="alert alert-info">
                            <h6 class="alert-heading fw-bold"><i class="fas fa-info-circle me-2"></i>Information</h6>
                            <p class="mb-0">Les Fun Facts sont des statistiques amusantes qui seront affichées sur la page d'accueil. Ils permettent de mettre en valeur des chiffres clés de manière attractive.</p>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.fun-facts.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 