@extends('admin.layouts.master')

@section('title', 'Gestion des sections de la page')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<style>
    .sections-list {
        list-style: none;
        padding: 0;
    }
    .section-item {
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 5px;
        margin-bottom: 10px;
        position: relative;
    }
    .section-item.ui-sortable-helper {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .section-header {
        padding: 15px;
        border-bottom: 1px solid #e9ecef;
        cursor: move;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .section-header h5 {
        margin: 0;
        font-weight: 600;
    }
    .section-body {
        padding: 15px;
    }
    .section-actions {
        display: flex;
        gap: 5px;
    }
    .section-drag-handle {
        cursor: move;
        color: #adb5bd;
        margin-right: 10px;
    }
    .section-drag-handle:hover {
        color: #6c757d;
    }
    .section-status-inactive {
        opacity: 0.6;
    }
    .add-section-card {
        border: 2px dashed #e9ecef;
        border-radius: 5px;
        padding: 15px;
        text-align: center;
        margin-bottom: 20px;
    }
    .add-section-card:hover {
        border-color: #6c757d;
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Gestion des sections de la page : {{ $page->title }}</h4>
                </div>
                <div>
                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Retour à la page
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Ajouter une nouvelle section -->
                <div class="add-section-card mb-4">
                    <h5 class="mb-3">Ajouter une section à votre page</h5>
                    
                    <form action="{{ route('admin.page_sections.store', $page) }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <select class="form-control" name="section_id" required>
                                <option value="">Sélectionner un type de section</option>
                                @foreach($availableSections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="custom_class" placeholder="Classes CSS personnalisées (optionnel)">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fa fa-plus-circle me-2"></i>Ajouter
                            </button>
                        </div>
                    </form>
                </div>

                @if($pageSections->isEmpty())
                    <div class="alert alert-info" role="alert">
                        Aucune section n'a été ajoutée à cette page. Utilisez le formulaire ci-dessus pour ajouter votre première section.
                    </div>
                @else
                    <div class="alert alert-info mb-4" role="alert">
                        <i class="fa fa-info-circle me-2"></i> Faites glisser les sections pour modifier leur ordre.
                    </div>

                    <!-- Liste des sections -->
                    <ul id="sections-sortable" class="sections-list">
                        @foreach($pageSections as $pageSection)
                            <li class="section-item {{ !$pageSection->is_active ? 'section-status-inactive' : '' }}" data-id="{{ $pageSection->id }}">
                                <div class="section-header">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-grip-vertical section-drag-handle"></i>
                                        <h5>{{ $pageSection->section->name }}</h5>
                                        @if(!$pageSection->is_active)
                                            <span class="badge bg-warning ms-2">Désactivée</span>
                                        @endif
                                    </div>
                                    <div class="section-actions">
                                        <form action="{{ route('admin.page_sections.toggle', [$page, $pageSection]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm {{ $pageSection->is_active ? 'btn-warning' : 'btn-success' }}" title="{{ $pageSection->is_active ? 'Désactiver' : 'Activer' }}">
                                                <i class="fa {{ $pageSection->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.page_sections.edit', [$page, $pageSection]) }}" class="btn btn-sm btn-info" title="Modifier">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.page_sections.destroy', [$page, $pageSection]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette section ?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Type :</strong> {{ $pageSection->section->type }}</p>
                                            <p><strong>Composant :</strong> {{ $pageSection->section->blade_component }}</p>
                                            @if($pageSection->custom_class)
                                                <p><strong>Classe CSS :</strong> {{ $pageSection->custom_class }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Description :</strong></p>
                                            <p>{{ $pageSection->section->description ?? 'Aucune description disponible.' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialisation du tri par glisser-déposer
        $("#sections-sortable").sortable({
            handle: ".section-header, .section-drag-handle",
            placeholder: "section-item ui-state-highlight",
            update: function(event, ui) {
                // Récupérer les IDs dans le nouvel ordre
                const sections = [];
                $('.section-item').each(function(index) {
                    sections.push({
                        id: $(this).data('id'),
                        order: index + 1
                    });
                });
                
                // Envoyer les données au serveur
                $.ajax({
                    url: "{{ route('admin.page_sections.order', $page) }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        sections: sections
                    },
                    success: function(response) {
                        // Notification de succès
                        toastr.success("L'ordre des sections a été mis à jour avec succès.");
                    },
                    error: function(xhr) {
                        // Notification d'erreur
                        toastr.error("Une erreur est survenue lors de la mise à jour de l'ordre des sections.");
                        console.error(xhr);
                    }
                });
            }
        });
    });
</script>
@endpush 