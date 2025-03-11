@extends('admin.layouts.master')

@section('title', 'Modifier une catégorie')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.equipe-categories.index') }}">Catégories d'équipe</a></li>
        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Modifier la catégorie</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.equipe-categories.update', $equipeCategory) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title', $equipeCategory->title) }}" required>
                            <small class="form-text text-muted">Exemple : "Direction", "Conseil d'administration", "Équipe technique", etc.</small>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($equipeCategory->equipes->count() > 0)
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Cette catégorie contient actuellement {{ $equipeCategory->equipes->count() }} membre(s).
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Enregistrer les modifications
                        </button>
                        <a href="{{ route('admin.equipe-categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 