@extends('admin.layouts.master')

@section('title', 'Détails du Partenaire')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('partners.index') }}">Partenaires</a></li>
        <li class="breadcrumb-item active" aria-current="page">Détails</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ $partner->name }}</h5>
            <div>
                <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-info">
                    <i class="fas fa-edit me-1"></i>Modifier
                </a>
                <a href="{{ route('partners.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Logo</h6>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center" style="height: 200px;">
                            @if($partner->logo)
                                <img src="{{ asset($partner->logo) }}" alt="{{ $partner->name }}" class="img-fluid" style="max-height: 180px;">
                            @else
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Aucun logo disponible
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Informations</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%">Nom</th>
                                        <td>{{ $partner->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Site Web</th>
                                        <td>
                                            @if($partner->website)
                                                <a href="{{ $partner->website }}" target="_blank">
                                                    {{ $partner->website }} <i class="fas fa-external-link-alt ms-1 small"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">Non défini</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date d'ajout</th>
                                        <td>{{ $partner->created_at->format('d/m/Y à H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dernière modification</th>
                                        <td>{{ $partner->updated_at->format('d/m/Y à H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    @if($partner->description)
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="mb-0">Description</h6>
                            </div>
                            <div class="card-body">
                                <p>{{ $partner->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Actions</h6>
                            <div class="d-flex gap-2">
                                <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-info">
                                    <i class="fas fa-edit me-1"></i>Modifier
                                </a>
                                <form action="{{ route('partners.destroy', $partner->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce partenaire ?')">
                                        <i class="fas fa-trash me-1"></i>Supprimer
                                    </button>
                                </form>
                                <a href="{{ route('partners.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 