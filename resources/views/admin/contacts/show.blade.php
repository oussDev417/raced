@extends('admin.layouts.master')

@section('title', 'Détails du message')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Messages</a></li>
        <li class="breadcrumb-item active" aria-current="page">Détails</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Détails du message</h5>
            <div>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Supprimer
                    </button>
                </form>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary ms-2">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="fw-bold">Informations de l'expéditeur</h6>
                        <hr>
                        <dl class="row">
                            <dt class="col-sm-4">Nom</dt>
                            <dd class="col-sm-8">{{ $contact->name }}</dd>

                            <dt class="col-sm-4">Prénom</dt>
                            <dd class="col-sm-8">{{ $contact->prenom }}</dd>

                            <dt class="col-sm-4">Email</dt>
                            <dd class="col-sm-8">
                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                            </dd>

                            <dt class="col-sm-4">Téléphone</dt>
                            <dd class="col-sm-8">
                                <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                            </dd>

                            <dt class="col-sm-4">Date d'envoi</dt>
                            <dd class="col-sm-8">{{ $contact->created_at->format('d/m/Y H:i') }}</dd>
                        </dl>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="fw-bold">Contenu du message</h6>
                        <hr>
                        <dl class="row">
                            <dt class="col-sm-4">Objet</dt>
                            <dd class="col-sm-8">{{ $contact->objet }}</dd>

                            <dt class="col-sm-4">Message</dt>
                            <dd class="col-sm-8">
                                <div class="message-content p-3 bg-light rounded">
                                    {!! nl2br(e($contact->message)) !!}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .message-content {
        white-space: pre-wrap;
        word-wrap: break-word;
        min-height: 100px;
    }
    
    dt {
        font-weight: 600;
        color: #6c757d;
    }
    
    dd {
        margin-bottom: 1rem;
    }
</style>
@endsection 