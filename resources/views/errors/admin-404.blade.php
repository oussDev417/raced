@php
// Définir les paramètres directement dans la vue
$settings = (object)[
    'site_name' => 'RACED ONG',
    'site_slogan' => 'Organisation Non Gouvernementale',
    'contact_address' => 'Cotonou, Bénin',
    'contact_phone' => '+229 97 77 77 77',
    'contact_email' => 'contact@racedong.org',
    'contact_hours' => 'Lundi - Vendredi : 08:00 - 17:00',
    'facebook' => true,
    'twitter' => true,
    'instagram' => true,
    'youtube' => true,
    'linkedin' => true,
    'whatsapp' => true,
    'tiktok' => true,
    'facebook_url' => '#',
    'twitter_url' => '#',
    'instagram_url' => '#',
    'youtube_url' => '#',
    'linkedin_url' => '#',
    'whatsapp_url' => '#',
    'tiktok_url' => '#',
    'footer_text' => '© ' . date('Y') . ' - RACED ONG - Tous droits réservés'
];
@endphp

@extends('admin.layouts.master')

@section('title', 'Page non trouvée')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Erreur</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center py-5">
                <div class="card-body">
                    <div class="mb-4">
                        <img src="{{ asset('assets/img/404-img.png') }}" alt="Erreur 404" class="img-fluid" style="max-width: 300px;">
                    </div>
                    <h1 class="card-title mb-4">Oups! Quelque chose s'est mal passé</h1>
                    <p class="card-text mb-4">Désolé, mais la page que vous recherchez n'est pas disponible actuellement.</p>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i> Retour au tableau de bord
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 