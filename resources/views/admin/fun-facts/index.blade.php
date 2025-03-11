@extends('admin.layouts.master')

@section('title', 'Gestion des Fun Facts')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Fun Facts</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des Fun Facts</h5>
            <a href="{{ route('admin.fun-facts.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter un Fun Fact
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th>Titre</th>
                            <th>Compteur</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-url="{{ route('admin.fun-facts.update-order') }}">
                        @forelse($funFacts as $funFact)
                            <tr data-id="{{ $funFact->id }}">
                                <td>
                                    <div class="sortable-handle cursor-pointer">
                                        <i class="fas fa-grip-vertical"></i>
                                    </div>
                                </td>
                                <td>{{ $funFact->title }}</td>
                                <td>{{ $funFact->count }}</td>
                                <td>{{ $funFact->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.fun-facts.edit', $funFact) }}" class="btn btn-sm btn-info" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.fun-facts.destroy', $funFact) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce Fun Fact ?');">
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
                                <td colspan="5" class="text-center">Aucun Fun Fact trouvé.</td>
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
        const order = Array.from(rows).map((row, index) => {
            return {
                id: row.dataset.id,
                position: index + 1
            };
        });

        // Envoi de l'ordre au serveur
        fetch(document.querySelector('.sortable').dataset.url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ order })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Ordre mis à jour avec succès', 'success');
            } else {
                showNotification('Erreur lors de la mise à jour de l\'ordre', 'error');
            }
        })
        .catch(error => {
            showNotification('Erreur lors de la mise à jour de l\'ordre', 'error');
        });
    }
</script>
@endsection 