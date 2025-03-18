@extends('admin.layouts.master')

@section('title', 'Constructeur de menu')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Constructeur de menu : {{ $menu->name }}</h4>
                    <p class="text-muted mb-0">Emplacement : {{ $locations[$menu->location] ?? $menu->location }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.menu_items.create', $menu) }}" class="btn btn-success me-2">
                        <i class="fa fa-plus-circle me-2"></i>Ajouter un élément
                    </a>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="alert alert-info mb-3">
                    <i class="fas fa-info-circle me-2"></i> Utilisez les poignées <i class="fas fa-grip-vertical"></i> pour faire glisser et réorganiser les éléments du menu. Les modifications sont enregistrées automatiquement.
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if($menu->items->count() > 0)
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Structure du menu</h5>
                                </div>
                                <div class="card-body">
                                    <div class="menu-builder">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px;"></th>
                                                    <th>Titre</th>
                                                    <th>Type</th>
                                                    <th>Statut</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortable-menu-items" data-url="{{ route('admin.menus.update_order', $menu) }}">
                                                @foreach($menu->items()->whereNull('parent_id')->orderBy('order')->get() as $item)
                                                    <tr data-id="{{ $item->id }}">
                                                        <td>
                                                            <div class="handle">
                                                                <i class="fas fa-grip-vertical"></i>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if($item->icon)
                                                                <i class="{{ $item->icon }} me-2"></i>
                                                            @endif
                                                            <span class="fw-bold">{{ $item->title }}</span>
                                                        </td>
                                                        <td>
                                                            @if($item->page_id)
                                                                <span class="badge bg-primary">Page</span>
                                                            @else
                                                                <span class="badge bg-secondary">URL externe</span>
                                                            @endif
                                                            
                                                            @if($item->target == '_blank')
                                                                <span class="badge bg-info ms-1">Nouvel onglet</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($item->is_active)
                                                                <span class="badge bg-success">Actif</span>
                                                            @else
                                                                <span class="badge bg-warning">Inactif</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="{{ route('admin.menu_items.edit', [$menu, $item]) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                
                                                                <form action="{{ route('admin.menu_items.toggle', [$menu, $item]) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-dark' : 'btn-success' }}" title="{{ $item->is_active ? 'Désactiver' : 'Activer' }}">
                                                                        <i class="fa fa-{{ $item->is_active ? 'eye-slash' : 'eye' }}"></i>
                                                                    </button>
                                                                </form>
                                                                
                                                                <form action="{{ route('admin.menu_items.destroy', [$menu, $item]) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élément de menu ? Cette action est irréversible et supprimera également tous les sous-éléments.');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                                    @if($item->children && $item->children->count() > 0)
                                                        @foreach($item->children()->orderBy('order')->get() as $child)
                                                            <tr data-id="{{ $child->id }}" data-parent-id="{{ $item->id }}" class="child-item">
                                                                <td>
                                                                    <div class="handle ms-3">
                                                                        <i class="fas fa-grip-vertical"></i>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="ms-3">
                                                                        <i class="fas fa-level-down-alt fa-rotate-90 me-2 text-muted"></i>
                                                                        @if($child->icon)
                                                                            <i class="{{ $child->icon }} me-2"></i>
                                                                        @endif
                                                                        <span class="fw-bold">{{ $child->title }}</span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    @if($child->page_id)
                                                                        <span class="badge bg-primary">Page</span>
                                                                    @else
                                                                        <span class="badge bg-secondary">URL externe</span>
                                                                    @endif
                                                                    
                                                                    @if($child->target == '_blank')
                                                                        <span class="badge bg-info ms-1">Nouvel onglet</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($child->is_active)
                                                                        <span class="badge bg-success">Actif</span>
                                                                    @else
                                                                        <span class="badge bg-warning">Inactif</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group" role="group">
                                                                        <a href="{{ route('admin.menu_items.edit', [$menu, $child]) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                        
                                                                        <form action="{{ route('admin.menu_items.toggle', [$menu, $child]) }}" method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <button type="submit" class="btn btn-sm {{ $child->is_active ? 'btn-dark' : 'btn-success' }}" title="{{ $child->is_active ? 'Désactiver' : 'Activer' }}">
                                                                                <i class="fa fa-{{ $child->is_active ? 'eye-slash' : 'eye' }}"></i>
                                                                            </button>
                                                                        </form>
                                                                        
                                                                        <form action="{{ route('admin.menu_items.destroy', [$menu, $child]) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élément de menu ? Cette action est irréversible.');">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <p>Ce menu ne contient aucun élément pour le moment.</p>
                                <a href="{{ route('admin.menu_items.create', $menu) }}" class="btn btn-success mt-2">
                                    <i class="fa fa-plus-circle me-2"></i>Ajouter un premier élément
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .handle {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        font-size: 1.2em;
        cursor: move;
        background-color: #f1f1f1;
        border-radius: 4px;
        width: 30px;
        height: 30px;
        transition: all 0.2s ease;
    }
    .handle:hover {
        color: #333;
        background-color: #ddd;
    }
    .child-item {
        background-color: #f8f9fa;
    }
    .sortable-ghost {
        opacity: 0.5;
        background: #c8ebfb !important;
    }
    .sortable-chosen {
        background: #f0f0f0;
    }
    .sortable-drag {
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    #sortable-menu-items tr {
        transition: background-color 0.3s ease;
    }
    #sortable-menu-items tr:hover {
        background-color: #f5f5f5;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableList = document.getElementById('sortable-menu-items');
    
    if (sortableList) {
        new Sortable(sortableList, {
            handle: '.handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                const loading = toastr.info('Mise à jour de l\'ordre en cours...', '', {
                    timeOut: 0,
                    extendedTimeOut: 0,
                    closeButton: false,
                    tapToDismiss: false
                });

                const items = [];
                document.querySelectorAll('#sortable-menu-items tr').forEach((row, index) => {
                    const id = row.getAttribute('data-id');
                    const parentId = row.getAttribute('data-parent-id');
                    
                    if (id) {
                        items.push({
                            id: parseInt(id),
                            parent_id: parentId ? parseInt(parentId) : null,
                            order: index + 1
                        });
                    }
                });

                fetch(sortableList.dataset.url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ items: items })
                })
                .then(response => response.json())
                .then(data => {
                    toastr.clear(loading);
                    if (data.success) {
                        toastr.success('Ordre du menu mis à jour avec succès');
                    } else {
                        toastr.error(data.message || 'Une erreur est survenue lors de la mise à jour');
                        // Revert the change
                        evt.from.insertBefore(evt.item, evt.from.children[evt.oldIndex]);
                    }
                })
                .catch(error => {
                    toastr.clear(loading);
                    console.error('Erreur:', error);
                    toastr.error('Une erreur est survenue lors de la mise à jour');
                    // Revert the change
                    evt.from.insertBefore(evt.item, evt.from.children[evt.oldIndex]);
                });
            }
        });
    }
});
</script>
@endpush 