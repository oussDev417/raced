@extends('admin.layouts.master')

@section('title', 'Détails de l\'image')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Galerie</a></li>
        <li class="breadcrumb-item active" aria-current="page">Détails de l'image</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ $image->title }}</h5>
            <div>
                <a href="{{ route('admin.gallery.edit', $image->id) }}" class="btn btn-info">
                    <i class="fas fa-edit me-1"></i>Modifier
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Retour à la galerie
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Image</h6>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset($image->path) }}" alt="{{ $image->title }}" class="img-fluid rounded" style="max-height: 500px;">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Informations</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 40%">Titre</th>
                                        <td>{{ $image->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Catégorie</th>
                                        <td>
                                            @if($image->category)
                                                <span class="badge bg-info">{{ $image->category->name }}</span>
                                            @else
                                                <span class="text-muted">Non catégorisée</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date d'ajout</th>
                                        <td>{{ $image->created_at->format('d/m/Y à H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dernière modification</th>
                                        <td>{{ $image->updated_at->format('d/m/Y à H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Taille du fichier</th>
                                        <td>
                                            @if(file_exists(public_path($image->path)))
                                                {{ round(filesize(public_path($image->path)) / 1024, 2) }} Ko
                                            @else
                                                <span class="text-danger">Fichier introuvable</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    @if($image->description)
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="mb-0">Description</h6>
                            </div>
                            <div class="card-body">
                                <p>{{ $image->description }}</p>
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
                                <a href="{{ route('admin.gallery.edit', $image->id) }}" class="btn btn-info">
                                    <i class="fas fa-edit me-1"></i>Modifier
                                </a>
                                <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?')">
                                        <i class="fas fa-trash me-1"></i>Supprimer
                                    </button>
                                </form>
                                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Retour à la galerie
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