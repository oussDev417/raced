@extends('admin.layouts.master')

@section('title', 'Newsletters')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Newsletters</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Newsletters</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                </div>
                            </th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($newsletters as $newsletter)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input message-checkbox" type="checkbox" value="{{ $newsletter->id }}">
                                    </div>
                                </td>
                                <td>{{ $newsletter->email }}</td>
                                <td>{{ $newsletter->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('admin.newsletters.destroy', $newsletter) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucune newsletter trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .btn-group {
        gap: 0.5rem;
    }
    
    .table td {
        vertical-align: middle;
    }
</style>
@endsection

@section('scripts')
@endsection 