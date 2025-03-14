@extends('admin.layouts.master')

@section('title', 'Témoignages')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Témoignages</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des témoignages</h5>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter un témoignage
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
                            <th>Message</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @forelse($testimonials as $testimonial)
                            <tr data-id="{{ $testimonial->id }}">
                                <td>
                                    <span class="sortable-handle">
                                        <i class="fas fa-grip-vertical"></i>
                                    </span>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/testimonials/' . $testimonial->image) }}" 
                                         alt="{{ $testimonial->name }}" 
                                         class="img-thumbnail"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                </td>
                                <td>{{ $testimonial->name }}</td>
                                <td>{{ $testimonial->position }}</td>
                                <td>{{ $testimonial->message }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce témoignage ?');">
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