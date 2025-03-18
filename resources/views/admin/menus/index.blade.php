@extends('admin.layouts.master')

@section('title', 'Gestion des menus')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Liste des menus</h4>
                </div>
                <div>
                    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle me-2"></i>Ajouter un menu
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="menus-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Emplacement</th>
                                <th>Éléments</th>
                                <th>Créé le</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $menu->id }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->location }}</td>
                                    <td>{{ $menu->items_count }}</td>
                                    <td>{{ $menu->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.menus.builder', $menu) }}" 
                                                class="btn btn-sm btn-info" 
                                                data-bs-toggle="tooltip" 
                                                title="Construire le menu">
                                                <i class="fa fa-sitemap"></i>
                                            </a>
                                            <a href="{{ route('admin.menus.edit', $menu) }}" 
                                                class="btn btn-sm btn-warning" 
                                                data-bs-toggle="tooltip" 
                                                title="Modifier">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="tooltip" 
                                                    title="Supprimer"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu ? Cette action est irréversible.')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#menus-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json'
            },
            order: [[0, 'desc']]
        });
        
        // Initialiser les tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush 