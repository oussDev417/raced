@extends('admin.layouts.master')

@section('title', 'Catégories d\'actualités')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Actualités</a></li>
        <li class="breadcrumb-item active" aria-current="page">Catégories</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Liste des catégories</h5>
            <a href="{{ route('admin.news-categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter une catégorie
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th>Titre</th>
                            <th>Nombre d'actualités</th>
                            <th>Date de création</th>
                            <th width="200px">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @forelse($categories as $category)
                        <tr data-id="{{ $category->id }}">
                            <td>
                                <span class="sortable-handle">
                                    <i class="fas fa-grip-vertical"></i>
                                </span>
                            </td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->news_count }}</td>
                            <td>{{ $category->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.news-categories.edit', $category->id) }}" 
                                    class="btn btn-primary btn-sm" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.news-categories.destroy', $category->id) }}" 
                                    method="POST" class="d-inline-block"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ? Toutes les actualités associées seront également supprimées.');">
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    var sortable = new Sortable(document.getElementById('sortable'), {
        handle: '.sortable-handle',
        animation: 150,
        onEnd: function() {
            updateOrder('news-categories');
        }
    });
});
</script>
@endsection 