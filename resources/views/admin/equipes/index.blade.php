@extends('admin.layouts.master')

@section('title', 'Membres de l\'équipe')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Membres de l'équipe</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des membres de l'équipe</h5>
            <a href="{{ route('admin.equipes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter un membre
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th style="width: 100px;">Photo</th>
                            <th>Nom</th>
                            <th>Poste</th>
                            <th>Catégorie</th>
                            <th>Contact</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-url="{{ route('admin.equipes.updateOrder') }}">
                        @forelse($equipes as $equipe)
                            <tr data-id="{{ $equipe->id }}">
                                <td>
                                    <span class="sortable-handle">
                                        <i class="fas fa-grip-vertical"></i>
                                    </span>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/equipes/' . $equipe->image) }}" 
                                         alt="{{ $equipe->name }}" 
                                         class="img-thumbnail"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                </td>
                                <td>{{ $equipe->name }}</td>
                                <td>{{ $equipe->position }}</td>
                                <td>{{ $equipe->category->title }}</td>
                                <td>
                                    @if($equipe->phone)
                                        <div><i class="fas fa-phone me-2"></i>{{ $equipe->phone }}</div>
                                    @endif
                                    @if($equipe->email)
                                        <div><i class="fas fa-envelope me-2"></i>{{ $equipe->email }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.equipes.edit', $equipe) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.equipes.destroy', $equipe) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun membre trouvé</td>
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
document.addEventListener('DOMContentLoaded', function() {
    const sortable = document.querySelector('.sortable');
    if (sortable) {
        new Sortable(sortable, {
            handle: '.sortable-handle',
            animation: 150,
            onEnd: function() {
                const items = [...sortable.querySelectorAll('tr')].map((tr, index) => ({
                    id: tr.dataset.id,
                    order: index + 1
                }));

                fetch(sortable.dataset.url, {
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
                        showNotification('Ordre mis à jour avec succès', 'success');
                    } else {
                        showNotification('Erreur lors de la mise à jour de l\'ordre', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Erreur lors de la mise à jour de l\'ordre', 'error');
                });
            }
        });
    }
});
</script>
@endsection 