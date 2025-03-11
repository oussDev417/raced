@extends('admin.layouts.master')

@section('title', 'Modifier une statistique')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.stat-facts.index') }}">Statistiques</a></li>
        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Modifier la statistique</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.stat-facts.update', $statFact) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title', $statFact->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="counter" class="form-label">Compteur <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('counter') is-invalid @enderror" 
                                id="counter" name="counter" value="{{ old('counter', $statFact->counter) }}" required>
                            <small class="form-text text-muted">Exemple : "100", "1K", "1M", etc.</small>
                            @error('counter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="counter_after" class="form-label">Texte après le compteur</label>
                            <input type="text" class="form-control @error('counter_after') is-invalid @enderror" 
                                id="counter_after" name="counter_after" value="{{ old('counter_after', $statFact->counter_after) }}">
                            <small class="form-text text-muted">Exemple : "+", "%", "ans", etc.</small>
                            @error('counter_after')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Enregistrer les modifications
                        </button>
                        <a href="{{ route('admin.stat-facts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 