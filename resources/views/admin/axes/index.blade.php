@extends('admin.layouts.master')

@section('title', 'Opportunités')

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des opportunités</h5>
            <a href="{{ route('admin.axes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter une opportunité
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th width="100px">Image</th>
                            <th>Titre</th>
                            <th>Description courte</th>
                            <th>Date de création</th>
                            <th width="200px">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @forelse($axes as $axis)
                        <tr data-id="{{ $axis->id }}">
                            <td>
                                <span class="sortable-handle">
                                    <i class="fas fa-grip-vertical"></i>
                                </span>
                            </td>
                            <td>
                                @if($axis->image)
                                    <img src="{{ asset('storage/axes/' . $axis->image) }}" 
                                        alt="{{ $axis->title }}" class="img-thumbnail" 
                                        style="max-width: 80px;">
                                @else
                                    <img src="{{ asset('assets/images/no-image.png') }}" 
                                        alt="No Image" class="img-thumbnail" 
                                        style="max-width: 80px;">
                                @endif
                            </td>
                            <td>{{ $axis->title }}</td>
                            <td>{{ Str::limit($axis->short_description, 100) }}</td>
                            <td>{{ $axis->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('axes.show', $axis->slug) }}" 
                                    class="btn btn-info btn-sm" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.axes.edit', $axis->id) }}" 
                                    class="btn btn-primary btn-sm" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.axes.destroy', $axis->id) }}" 
                                    method="POST" class="d-inline-block"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet axe stratégique ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucun axe stratégique trouvé</td>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    var sortable = new Sortable(document.getElementById('sortable'), {
        handle: '.sortable-handle',
        animation: 150,
        onEnd: function() {
            updateOrder('strategic-axes');
        }
    });
});
</script>
@endsection 