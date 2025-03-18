@extends('admin.layouts.master')

@section('title', 'Gestion des Rapports')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Rapports</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des Rapports</h5>
            <a href="{{ route('admin.reports.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter un Rapport
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Date de publication</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-url="{{ route('admin.reports.update-order') }}">
                        @forelse($reports as $report)
                            <tr data-id="{{ $report->id }}">
                                <td>
                                    <div class="sortable-handle cursor-pointer">
                                        <i class="fas fa-grip-vertical"></i>
                                    </div>
                                </td>
                                <td>
                                    @if($report->image)
                                        <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->title }}" class="img-thumbnail" style="max-width: 50px;">
                                    @else
                                        <span class="badge bg-secondary">Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $report->title }}</td>
                                <td>{{ $report->publication_date ? $report->publication_date->format('d/m/Y') : 'Non définie' }}</td>
                                <td>
                                    <span class="badge bg-{{ $report->active ? 'success' : 'danger' }}">
                                        {{ $report->active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.reports.edit', $report) }}" class="btn btn-sm btn-info" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.reports.toggle-active', $report) }}" class="btn btn-sm {{ $report->active ? 'btn-warning' : 'btn-success' }}" title="{{ $report->active ? 'Désactiver' : 'Activer' }}">
                                            <i class="fas {{ $report->active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                        </a>
                                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?');">
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
                                <td colspan="6" class="text-center">Aucun rapport trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Initialisation du tri
    const sortable = new Sortable(document.querySelector('.sortable'), {
        handle: '.sortable-handle',
        animation: 150,
        onEnd: function() {
            updateOrder();
        }
    });

    // Mise à jour de l'ordre
    function updateOrder() {
        const rows = document.querySelectorAll('.sortable tr');
        const items = Array.from(rows).map((row, index) => {
            return {
                id: row.dataset.id,
                order: index + 1
            };
        });

        // Envoi de l'ordre au serveur
        fetch(document.querySelector('.sortable').dataset.url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ items })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success('Ordre mis à jour avec succès');
            } else {
                toastr.error('Erreur lors de la mise à jour de l\'ordre');
            }
        })
        .catch(error => {
            toastr.error('Erreur lors de la mise à jour de l\'ordre');
        });
    }
</script>
@endsection 