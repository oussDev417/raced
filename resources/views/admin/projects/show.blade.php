@extends('admin.layouts.master')

@section('title', 'Détails du projet')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projets</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $project->title }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ $project->title }}</h5>
            <div>
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit me-2"></i>Modifier
                </a>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">Titre</th>
                            <td>{{ $project->title }}</td>
                        </tr>
                        <tr>
                            <th>Description courte</th>
                            <td>{{ $project->short_description }}</td>
                        </tr>
                        <tr>
                            <th>Date de création</th>
                            <td>{{ $project->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Dernière modification</th>
                            <td>{{ $project->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <h6 class="fw-bold">Description détaillée</h6>
                        <div class="border rounded p-3 bg-light">
                            {!! $project->description !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Image du projet</h6>
                        </div>
                        <div class="card-body text-center">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" 
                                    alt="{{ $project->title }}" 
                                    class="img-fluid rounded">
                            @else
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Aucune image n'a été ajoutée pour ce projet
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 