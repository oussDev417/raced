@extends('admin.layouts.master')

@section('title', 'Gestion des pages')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Liste des pages</h4>
                </div>
                <div>
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle me-2"></i>Nouvelle page
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
                                <th>Titre</th>
                                <th>Slug</th>
                                <th>Template</th>
                                <th>Statut</th>
                                <th>Page d'accueil</th>
                                <th>Sections</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>{{ ucfirst($page->template ?? 'par défaut') }}</td>
                                <td>
                                    <span class="badge bg-{{ $page->status == 'published' ? 'success' : 'warning' }}">
                                        {{ $page->status == 'published' ? 'Publié' : 'Brouillon' }}
                                    </span>
                                </td>
                                <td>
                                    @if($page->is_home)
                                        <span class="badge bg-info">Accueil</span>
                                    @else
                                        <form action="{{ route('admin.pages.update', $page) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="set_as_home" value="1">
                                            <button type="submit" class="btn btn-sm btn-outline-info" onclick="return confirm('Définir cette page comme page d\'accueil ?')">
                                                Définir comme accueil
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.page_sections.index', $page) }}" class="btn btn-sm btn-primary">
                                        Gérer les sections ({{ $page->pageSections->count() }})
                                    </a>
                                </td>
                                <td>{{ $page->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette page ?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-sm btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>
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