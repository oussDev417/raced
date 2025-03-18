@extends('admin.layouts.master')

@section('title', 'Modifier un élément de menu')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Modifier l'élément de menu : {{ $menuItem->title }}</h4>
                </div>
                <div>
                    <a href="{{ route('admin.menus.builder', $menu) }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Retour au menu
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

                <form action="{{ route('admin.menu_items.update', [$menu, $menuItem]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Informations générales -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Informations générales</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $menuItem->title) }}" required>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="form-label d-block">Type de lien <span class="text-danger">*</span></label>
                                        
                                        <div class="form-check form-check-inline mb-3">
                                            <input class="form-check-input" type="radio" name="link_type" id="link_type_url" value="url" {{ old('link_type', $menuItem->page_id ? 'page' : 'url') == 'url' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="link_type_url">URL personnalisée</label>
                                        </div>
                                        
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="link_type" id="link_type_page" value="page" {{ old('link_type', $menuItem->page_id ? 'page' : 'url') == 'page' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="link_type_page">Page du site</label>
                                        </div>
                                        
                                        <p class="text-info mt-2">
                                            <i class="fa fa-info-circle"></i> Type actuel : <strong>{{ $menuItem->page_id ? 'Page du site' : 'URL personnalisée' }}</strong>
                                        </p>
                                    </div>

                                    <div class="form-group mb-3" id="url-field" style="{{ old('link_type', $menuItem->page_id ? 'page' : 'url') == 'page' ? 'display: none;' : '' }}">
                                        <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $menuItem->url) }}" placeholder="https://exemple.com">
                                        <small class="text-muted">Saisissez l'URL complète (ex: https://exemple.com/page).</small>
                                    </div>

                                    <div class="form-group mb-3" id="page-field" style="{{ old('link_type', $menuItem->page_id ? 'page' : 'url') == 'url' ? 'display: none;' : '' }}">
                                        <label for="page_id" class="form-label">Page <span class="text-danger">*</span></label>
                                        <select class="form-control" id="page_id" name="page_id">
                                            <option value="">Sélectionner une page</option>
                                            @foreach($pages as $id => $title)
                                                <option value="{{ $id }}" {{ old('page_id', $menuItem->page_id) == $id ? 'selected' : '' }}>{{ $title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="parent_id" class="form-label">Élément parent</label>
                                        <select class="form-control" id="parent_id" name="parent_id">
                                            <option value="">Élément de premier niveau</option>
                                            @foreach($parentItems as $id => $title)
                                                <option value="{{ $id }}" {{ old('parent_id', $menuItem->parent_id) == $id ? 'selected' : '' }}>{{ $title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="icon" class="form-label">Icône</label>
                                        <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $menuItem->icon) }}" placeholder="fa fa-home">
                                        <small class="text-muted">Classe d'icône (ex: fa fa-home)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Paramètres supplémentaires -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Paramètres</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="target" class="form-label">Cible</label>
                                        <select class="form-control" id="target" name="target">
                                            @foreach($targets as $value => $label)
                                                <option value="{{ $value }}" {{ old('target', $menuItem->target) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="order" class="form-label">Ordre</label>
                                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $menuItem->order) }}" min="0">
                                    </div>

                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $menuItem->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Élément actif</label>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations supplémentaires -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Informations</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Menu :</strong> {{ $menu->name }}</p>
                                    <p><strong>Créé le :</strong> {{ $menuItem->created_at->format('d/m/Y à H:i') }}</p>
                                    <p><strong>Dernière modification :</strong> {{ $menuItem->updated_at->format('d/m/Y à H:i') }}</p>
                                    
                                    @if($menuItem->children->count() > 0)
                                        <div class="alert alert-info mt-3">
                                            <i class="fa fa-info-circle me-2"></i> Cet élément a {{ $menuItem->children->count() }} sous-menu(s).
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fonction pour afficher/masquer les champs URL et Page en fonction du type sélectionné
        function toggleFields() {
            const linkType = document.querySelector('input[name="link_type"]:checked').value;
            
            if (linkType === 'url') {
                document.getElementById('url-field').style.display = 'block';
                document.getElementById('page-field').style.display = 'none';
                document.getElementById('page_id').value = '';
            } else {
                document.getElementById('url-field').style.display = 'none';
                document.getElementById('page-field').style.display = 'block';
                document.getElementById('url').value = '';
            }
        }
        
        // Ajouter les écouteurs d'événements pour les radios
        document.querySelectorAll('input[name="link_type"]').forEach(function(radio) {
            radio.addEventListener('change', toggleFields);
        });
        
        // Valider le formulaire avant la soumission
        document.querySelector('form').addEventListener('submit', function(e) {
            const linkType = document.querySelector('input[name="link_type"]:checked').value;
            
            if (linkType === 'url' && !document.getElementById('url').value) {
                e.preventDefault();
                alert('Veuillez saisir une URL pour le lien personnalisé.');
                return false;
            }
            
            if (linkType === 'page' && !document.getElementById('page_id').value) {
                e.preventDefault();
                alert('Veuillez sélectionner une page pour le lien interne.');
                return false;
            }
            
            return true;
        });
    });
</script>
@endpush 