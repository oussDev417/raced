@extends('admin.layouts.master')

@section('title', 'Actualités')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Actualités</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des actualités</h5>
            <div>
                <a href="{{ route('admin.news-categories.index') }}" class="btn btn-info">
                    <i class="fas fa-tags me-2"></i>Gérer les catégories
                </a>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Ajouter une actualité
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th width="100px">Image</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Description courte</th>
                            <th>Date de création</th>
                            <th width="200px">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @forelse($news as $item)
                        <tr data-id="{{ $item->id }}">
                            <td>
                                <span class="sortable-handle">
                                    <i class="fas fa-grip-vertical"></i>
                                </span>
                            </td>
                            <td>
                                @if($item->thumbnail)
                                    <img src="{{ asset($item->thumbnail) }}" 
                                        alt="{{ $item->title }}" class="img-thumbnail" 
                                        style="max-width: 80px;">
                                @else
                                    <img src="{{ asset('assets/images/no-image.png') }}" 
                                        alt="No Image" class="img-thumbnail" 
                                        style="max-width: 80px;">
                                @endif
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->category->title }}</td>
                            <td>{{ Str::limit($item->short_description, 100) }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('news.show', $item->slug) }}" 
                                    class="btn btn-info btn-sm" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.news.edit', $item->id) }}" 
                                    class="btn btn-primary btn-sm" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" 
                                    method="POST" class="d-inline-block"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');">
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
                            <td colspan="7" class="text-center">Aucune actualité trouvée</td>
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
            updateOrder('news');
        }
    });
});
</script>
@endsection 