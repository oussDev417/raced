@extends('admin.layouts.master')

@section('title', 'Gestion des Sliders')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sliders</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des Sliders</h5>
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i>Ajouter un slider
            </a>
        </div>
        <div class="card-body">
            @if($sliders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th style="width: 150px;">Image</th>
                                <th>Titre</th>
                                <th>Sous-titre</th>
                                <th>Boutons</th>
                                <th style="width: 100px;">Statut</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-sliders">
                            @foreach($sliders as $slider)
                                <tr data-id="{{ $slider->id }}">
                                    <td>
                                        <span class="handle" style="cursor: move;">
                                            <i class="fas fa-grip-vertical"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="img-thumbnail" style="max-height: 80px;">
                                    </td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->subtitle }}</td>
                                    <td>
                                        @if($slider->button_text || $slider->button_text_2)
                                            <div class="d-flex flex-column gap-2">
                                                @if($slider->button_text)
                                                    <a href="{{ $slider->button_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        {{ $slider->button_text }}
                                                    </a>
                                                @endif
                                                @if($slider->button_text_2)
                                                    <a href="{{ $slider->button_link_2 }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                        {{ $slider->button_text_2 }}
                                                    </a>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted">Aucun bouton</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $slider->status ? 'success' : 'danger' }}">
                                            {{ $slider->status ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce slider ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info mb-0">
                    <i class="fas fa-info-circle me-1"></i>Aucun slider n'a été créé pour le moment.
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
    const sortableList = document.getElementById('sortable-sliders');
    
    if (sortableList) {
        new Sortable(sortableList, {
            handle: '.handle',
            animation: 150,
            onEnd: function() {
                updateOrder();
            }
        });
    }
    
    function updateOrder() {
        const rows = document.querySelectorAll('#sortable-sliders tr');
        const sliders = [];
        
        rows.forEach((row, index) => {
            sliders.push({
                id: row.getAttribute('data-id'),
                order: index + 1
            });
        });
        
        fetch('{{ route("admin.sliders.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ sliders: sliders })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Ordre mis à jour avec succès');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la mise à jour de l\'ordre:', error);
        });
    }
});
</script>
@endsection 