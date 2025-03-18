@extends('admin.layouts.master')

@section('title', 'Gestion des Sections Génériques')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sections Génériques</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des Sections Génériques</h5>
            <a href="{{ route('admin.generic_sections.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter une Section
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th>Image/Vidéo</th>
                            <th>Titre</th>
                            <th>Contenu</th>
                            <th>Bouton</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-url="{{ route('admin.generic_sections.update-order') }}">
                        @forelse($sections as $section)
                            <tr data-id="{{ $section->id }}">
                                <td>
                                    <div class="sortable-handle cursor-pointer">
                                        <i class="fas fa-grip-vertical"></i>
                                    </div>
                                </td>
                                <td>
                                    @if($section->image)
                                        <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title }}" class="img-thumbnail" style="max-width: 50px;">
                                    @elseif($section->video_url)
                                        <i class="fas fa-video text-primary" title="{{ $section->video_url }}"></i>
                                    @else
                                        <span class="badge bg-secondary">Aucun média</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $section->title ?: 'Sans titre' }}</div>
                                    @if($section->subtitle)
                                        <small>{{ $section->subtitle }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($section->description)
                                        <span title="{{ $section->description }}">{{ Str::limit($section->description, 50) }}</span>
                                    @else
                                        <span class="text-muted">Aucune description</span>
                                    @endif
                                </td>
                                <td>
                                    @if($section->button_text)
                                        <a href="{{ $section->button_url ?: '#' }}" class="btn btn-sm btn-outline-secondary" target="_blank">
                                            {{ $section->button_text }}
                                        </a>
                                    @else
                                        <span class="text-muted">Aucun bouton</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $section->active ? 'success' : 'danger' }}">
                                        {{ $section->active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.generic_sections.edit', $section) }}" class="btn btn-sm btn-info" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.generic_sections.toggle-active', $section) }}" class="btn btn-sm {{ $section->active ? 'btn-warning' : 'btn-success' }}" title="{{ $section->active ? 'Désactiver' : 'Activer' }}">
                                            <i class="fas {{ $section->active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                        </a>
                                        <form action="{{ route('admin.generic_sections.destroy', $section) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette section ?');">
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
                                <td colspan="7" class="text-center">Aucune section générique trouvée.</td>
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