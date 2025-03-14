@extends('admin.layouts.master')

@section('title', 'Gestion des Partenaires')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Partenaires</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des Partenaires</h5>
            <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter un partenaire
            </a>
        </div>
        <div class="card-body">
            @if(count($partners) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">Logo</th>
                                <th width="20%">Nom</th>
                                <th width="20%">Site Web</th>
                                <th width="20%">Date d'ajout</th>
                                <th width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-partners">
                            @foreach($partners as $partner)
                                <tr data-id="{{ $partner->id }}">
                                    <td>
                                        <span class="sort-handle" style="cursor: grab;">
                                            <i class="fas fa-grip-vertical"></i>
                                        </span>
                                    </td>
                                    <td>
                                        @if($partner->image)
                                            <img src="{{ asset('storage/partners/' . $partner->image) }}" alt="{{ $partner->name }}" class="img-thumbnail" style="max-height: 50px;">
                                        @else
                                            <span class="badge bg-secondary">Pas de logo</span>
                                        @endif
                                    </td>
                                    <td>{{ $partner->name }}</td>
                                    <td>
                                        @if($partner->website)
                                            <a href="{{ $partner->website }}" target="_blank">{{ $partner->website }}</a>
                                        @else
                                            <span class="text-muted">Non défini</span>
                                        @endif
                                    </td>
                                    <td>{{ $partner->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.partners.show', $partner->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce partenaire ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Aucun partenaire trouvé. Commencez par en ajouter un !
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation de Sortable pour le tri par glisser-déposer
    const sortableList = document.getElementById('sortable-partners');
    if (sortableList) {
        new Sortable(sortableList, {
            handle: '.sort-handle',
            animation: 150,
            onEnd: function() {
                updateOrder();
            }
        });
    }

    // Fonction pour mettre à jour l'ordre des partenaires
    function updateOrder() {
        const rows = document.querySelectorAll('#sortable-partners tr');
        const order = Array.from(rows).map((row, index) => {
            return {
                id: row.dataset.id,
                position: index + 1
            };
        });

        // Envoi des données au serveur via AJAX
        fetch('{{ route("admin.partners.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ order: order })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Afficher un message de succès temporaire
                const alert = document.createElement('div');
                alert.className = 'alert alert-success alert-dismissible fade show';
                alert.innerHTML = `
                    <i class="fas fa-check-circle me-2"></i>
                    Ordre mis à jour avec succès
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                document.querySelector('.card-body').prepend(alert);
                
                // Supprimer l'alerte après 3 secondes
                setTimeout(() => {
                    alert.remove();
                }, 3000);
            }
        })
        .catch(error => console.error('Erreur lors de la mise à jour de l\'ordre:', error));
    }
});
</script>
@endsection 