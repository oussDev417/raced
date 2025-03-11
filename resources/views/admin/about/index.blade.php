@extends('admin.layouts.master')

@section('title', 'À propos')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">À propos</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">À propos</h5>
        </div>
        <div class="card-body">
            <p>Vous êtes redirigé vers la page d'édition...</p>
            <script>
                window.location.href = "{{ route('about.edit') }}";
            </script>
        </div>
    </div>
</div>
@endsection 