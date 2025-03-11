@extends('admin.layouts.master')

@section('title', 'Catégories d\'équipe')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Catégories d'équipe</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des catégories d'équipe</h5>
            <a href="{{ route('admin.equipe-categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter une catégorie
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th>Titre</th>
                            <th>Nombre de membres</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-url="{{ route('admin.equipe-categories.update-order') }}">
                        @forelse($categories as $category)
                            <tr data-id="{{ $category->id }}">
                                <td>
                                    <span class="sortable-handle">
                                        <i class="fas fa-grip-vertical"></i>
                                    </span>
                                </td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->equipes->count() }}</td>
                                <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.equipe-categories.edit', $category) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.equipe-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ? Cette action supprimera également tous les membres associés.');">
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
                                <td colspan="5" class="text-center">Aucune catégorie trouvée</td>
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