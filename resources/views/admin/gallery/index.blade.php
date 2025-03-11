@extends('admin.layouts.master')

@section('title', 'Gestion de la Galerie')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Galerie</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Galerie d'images</h5>
            <div>
                <a href="{{ route('admin.gallery.categories.index') }}" class="btn btn-info me-2">
                    <i class="fas fa-tags me-1"></i>Gérer les catégories
                </a>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Ajouter une image
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Filtres -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category-filter" class="form-label">Filtrer par catégorie</label>
                        <select class="form-select" id="category-filter">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-group w-100">
                        <div class="input-group">
                            <input type="text" class="form-control" id="search-input" placeholder="Rechercher par titre...">
                            <button class="btn btn-outline-secondary" type="button" id="search-button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Galerie -->
            <div class="row" id="gallery-container">
                @if(count($images) > 0)
                    @foreach($images as $image)
                        <div class="col-md-4 col-lg-3 mb-4 gallery-item" data-category="{{ $image->category_id ?? 0 }}">
                            <div class="card h-100">
                                <div class="card-img-top position-relative" style="height: 200px; overflow: hidden;">
                                    <img src="{{ asset($image->path) }}" class="img-fluid" alt="{{ $image->title }}" style="object-fit: cover; width: 100%; height: 100%;">
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">{{ $image->title }}</h6>
                                    @if($image->category)
                                        <p class="card-text">
                                            <span class="badge bg-info">{{ $image->category->name }}</span>
                                        </p>
                                    @endif
                                    <p class="card-text small text-muted">
                                        Ajoutée le {{ $image->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div class="card-footer bg-white">
                                    <div class="btn-group w-100">
                                        <a href="{{ route('admin.gallery.edit', $image->id) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.gallery.show', $image->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Aucune image dans la galerie. Commencez par en ajouter une !
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($images->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $images->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filtrage par catégorie
    const categoryFilter = document.getElementById('category-filter');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    function filterGallery() {
        const categoryValue = categoryFilter.value;
        const searchValue = searchInput.value.toLowerCase();
        
        galleryItems.forEach(item => {
            const categoryMatch = categoryValue === '' || item.dataset.category === categoryValue;
            const titleElement = item.querySelector('.card-title');
            const searchMatch = titleElement ? titleElement.textContent.toLowerCase().includes(searchValue) : true;
            
            if (categoryMatch && searchMatch) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        
        // Afficher un message si aucun résultat
        const visibleItems = document.querySelectorAll('.gallery-item[style="display: block"]');
        const container = document.getElementById('gallery-container');
        const noResultsMessage = document.getElementById('no-results-message');
        
        if (visibleItems.length === 0 && !noResultsMessage) {
            const message = document.createElement('div');
            message.id = 'no-results-message';
            message.className = 'col-12 mt-3';
            message.innerHTML = `
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>Aucune image ne correspond à votre recherche.
                </div>
            `;
            container.appendChild(message);
        } else if (visibleItems.length > 0 && noResultsMessage) {
            noResultsMessage.remove();
        }
    }
    
    categoryFilter.addEventListener('change', filterGallery);
    searchButton.addEventListener('click', filterGallery);
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            filterGallery();
        }
    });
});
</script>
@endsection 