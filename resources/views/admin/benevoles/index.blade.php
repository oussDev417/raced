@extends('admin.layouts.master')

@section('title', 'Gestion des bénévoles')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Bénévoles</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des bénévoles</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Date d'inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($benevoles as $benevole)
                            <tr>
                                <td>{{ $benevole->name }}</td>
                                <td>{{ $benevole->prenom }}</td>
                                <td>{{ $benevole->email }}</td>
                                <td>{{ $benevole->phone }}</td>
                                <td>{{ $benevole->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('admin.benevoles.destroy', $benevole) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce bénévole ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun bénévole trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .btn-group {
        gap: 0.5rem;
    }
    
    .table td {
        vertical-align: middle;
    }
</style>
@endsection 