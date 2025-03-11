@extends('admin.layouts.master')

@section('title', 'Catégories de la Galerie')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Galerie</a></li>
        <li class="breadcrumb-item active" aria-current="page">Catégories</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Liste des catégories -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Catégories de la galerie</h5>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Retour à la galerie
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-1"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(count($categories) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="30%">Nom</th>
                                        <th width="30%">Slug</th>
                                        <th width="15%">Images</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td><code>{{ $category->slug }}</code></td>
                                            <td>
                                                <span class="badge bg-primary">{{ $category->images_count ?? 0 }} images</span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info edit-category" 
                                                    data-id="{{ $category->id }}" 
                                                    data-name="{{ $category->name }}"
                                                    data-description="{{ $category->description }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('admin.gallery.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ? Les images associées ne seront pas supprimées mais perdront leur catégorie.')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Aucune catégorie trouvée. Utilisez le formulaire ci-contre pour en ajouter.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Formulaire d'ajout/modification -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0" id="form-title">Ajouter une catégorie</h5>
                </div>
                <div class="card-body">
                    <form id="category-form" action="{{ route('admin.gallery.categories.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="category_id" name="category_id">
                        <div id="method-field"></div>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom de la catégorie <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Optionnel. Une brève description de la catégorie.</small>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" id="submit-btn">
                                <i class="fas fa-save me-1"></i>Enregistrer
                            </button>
                            <button type="button" class="btn btn-secondary" id="reset-btn" style="display: none;">
                                <i class="fas fa-times me-1"></i>Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('category-form');
    const formTitle = document.getElementById('form-title');
    const submitBtn = document.getElementById('submit-btn');
    const resetBtn = document.getElementById('reset-btn');
    const categoryIdInput = document.getElementById('category_id');
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const methodField = document.getElementById('method-field');
    
    // Gérer le clic sur le bouton d'édition
    document.querySelectorAll('.edit-category').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const description = this.dataset.description || '';
            
            // Mettre à jour le formulaire pour l'édition
            formTitle.textContent = 'Modifier une catégorie';
            submitBtn.innerHTML = '<i class="fas fa-save me-1"></i>Mettre à jour';
            resetBtn.style.display = 'block';
            
            // Remplir le formulaire avec les données existantes
            categoryIdInput.value = id;
            nameInput.value = name;
            descriptionInput.value = description;
            
            // Changer la méthode et l'action du formulaire
            form.action = `{{ url('admin/gallery/categories') }}/${id}`;
            methodField.innerHTML = '@method("PUT")';
            
            // Faire défiler jusqu'au formulaire
            form.scrollIntoView({ behavior: 'smooth' });
        });
    });
    
    // Réinitialiser le formulaire
    resetBtn.addEventListener('click', function() {
        resetForm();
    });
    
    function resetForm() {
        formTitle.textContent = 'Ajouter une catégorie';
        submitBtn.innerHTML = '<i class="fas fa-save me-1"></i>Enregistrer';
        resetBtn.style.display = 'none';
        
        categoryIdInput.value = '';
        nameInput.value = '';
        descriptionInput.value = '';
        
        form.action = "{{ route('admin.gallery.categories.store') }}";
        methodField.innerHTML = '';
    }
});
</script>
@endsection 