@extends('admin.layouts.master')

@section('title', 'Tableau de bord')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Tableau de bord</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="dashboard-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-title">Tableau de bord</h1>
        </div>
    </div>
    
    <!-- Statistiques -->
    <div class="row mt-4">
        <div class="col-xl-4 col-md-6">
            <div class="card stat-card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Utilisateurs</h5>
                            <h2 class="stat-number">{{ $stats['users'] }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('admin.users.index') }}">Voir les détails</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6">
            <div class="card stat-card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Bénévoles</h5>
                            <h2 class="stat-number">{{ $stats['benevoles'] }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-hands-helping fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('admin.benevoles.index') }}">Voir les détails</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6">
            <div class="card stat-card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Messages</h5>
                            <h2 class="stat-number">{{ $stats['messages'] }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-envelope fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('admin.contacts.index') }}">Voir les détails</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6">
            <div class="card stat-card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Actualités</h5>
                            <h2 class="stat-number">{{ $stats['news'] }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-newspaper fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('admin.news.index') }}">Voir les détails</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6">
            <div class="card stat-card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Projets</h5>
                            <h2 class="stat-number">{{ $stats['projects'] }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-project-diagram fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('admin.projects.index') }}">Voir les détails</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6">
            <div class="card stat-card bg-secondary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Galerie</h5>
                            <h2 class="stat-number">{{ $stats['galeries'] }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-images fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('admin.gallery.index') }}">Voir les détails</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Listes récentes -->
    <div class="row mt-4">
        <!-- Messages récents -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-envelope me-1"></i>
                    Messages récents
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stats['recent_messages'] as $message)
                                <tr>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.contacts.show', $message->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucun message récent</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">Voir tous les messages</a>
                </div>
            </div>
        </div>
        
        <!-- Bénévoles récents -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-hands-helping me-1"></i>
                    Bénévoles récents
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stats['recent_benevoles'] as $benevole)
                                <tr>
                                    <td>{{ $benevole->name }}</td>
                                    <td>{{ $benevole->email }}</td>
                                    <td>{{ $benevole->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.benevoles.show', $benevole->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucun bénévole récent</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.benevoles.index') }}" class="btn btn-primary">Voir tous les bénévoles</a>
                </div>
            </div>
        </div>
        
        <!-- Actualités récentes -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-newspaper me-1"></i>
                    Actualités récentes
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Catégorie</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stats['recent_news'] as $news)
                                <tr>
                                    <td>{{ $news->title }}</td>
                                    <td>{{ $news->category->name ?? 'Non catégorisé' }}</td>
                                    <td>{{ $news->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if($news->status)
                                            <span class="badge bg-success">Publié</span>
                                        @else
                                            <span class="badge bg-warning">Brouillon</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.news.show', $news->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucune actualité récente</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-primary">Voir toutes les actualités</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0;
    }
    
    .stat-icon {
        opacity: 0.7;
    }
</style>
@endsection 