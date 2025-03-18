@extends('admin.layouts.master')

@section('title', 'Types de sections')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Types de sections disponibles</h4>
                </div>
                <div>
                    <a href="{{ route('admin.sections.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle me-2"></i>Nouveau type de section
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
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Composant</th>
                                <th>Description</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sections as $section)
                            <tr>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->type }}</td>
                                <td>{{ $section->blade_component }}</td>
                                <td>{{ Str::limit($section->description, 50) }}</td>
                                <td>
                                    <span class="badge bg-{{ $section->is_active ? 'success' : 'warning' }}">
                                        {{ $section->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.sections.toggle', $section) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm {{ $section->is_active ? 'btn-warning' : 'btn-success' }}" title="{{ $section->is_active ? 'Désactiver' : 'Activer' }}">
                                            <i class="fa {{ $section->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.sections.edit', $section) }}" class="btn btn-sm btn-info" title="Modifier">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de section ?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
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
        $('#datatable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
            }
        });
    });
</script>
@endpush 