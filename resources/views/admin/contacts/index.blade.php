@extends('admin.layouts.master')

@section('title', 'Messages de contact')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Messages</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Messages de contact</h5>
            <div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSelectedModal" disabled id="deleteSelectedBtn">
                    <i class="fas fa-trash me-2"></i>Supprimer la sélection
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                </div>
                            </th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Objet</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input message-checkbox" type="checkbox" value="{{ $contact->id }}">
                                    </div>
                                </td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->prenom }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->objet }}</td>
                                <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">
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
                                <td colspan="8" class="text-center">Aucun message trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression multiple -->
<div class="modal fade" id="deleteSelectedModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer les messages sélectionnés ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('admin.contacts.destroyMultiple') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ids" id="selectedIds">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
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

@section('scripts')
<script>
    // Gestion de la sélection multiple
    const selectAll = document.getElementById('selectAll');
    const messageCheckboxes = document.querySelectorAll('.message-checkbox');
    const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
    const selectedIdsInput = document.getElementById('selectedIds');
    
    // Sélectionner/désélectionner tout
    selectAll.addEventListener('change', function() {
        messageCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateDeleteButton();
    });
    
    // Mettre à jour le bouton de suppression
    messageCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateDeleteButton);
    });
    
    function updateDeleteButton() {
        const selectedCheckboxes = document.querySelectorAll('.message-checkbox:checked');
        deleteSelectedBtn.disabled = selectedCheckboxes.length === 0;
        
        // Mettre à jour les IDs sélectionnés
        const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);
        selectedIdsInput.value = selectedIds.join(',');
        
        // Mettre à jour l'état de la case "Tout sélectionner"
        selectAll.checked = selectedCheckboxes.length === messageCheckboxes.length;
    }
</script>
@endsection 