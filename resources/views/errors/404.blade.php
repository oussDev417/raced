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

@extends('frontend.layouts.master')

@section('title', 'Page non trouvée')
@section('meta_description', 'Page non trouvée - RACED ONG')
@section('meta_keywords', 'erreur, 404, page non trouvée, RACED ONG')

@section('content')
    <!-- BREADCRUMBS SECTION START -->
    <section class="ul-breadcrumb ul-section-spacing">
        <div class="ul-container">
            <h2 class="ul-breadcrumb-title">Erreur</h2>
            <ul class="ul-breadcrumb-nav">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li><span class="separator"><i class="flaticon-right"></i></span></li>
                <li>Erreur</li>
            </ul>
        </div>
    </section>
    <!-- BREADCRUMBS SECTION END -->

    <!-- 404 SECTION START -->
    <section class="ul-404 ul-section-spacing text-center">
        <div class="ul-404-container">
            <div class="ul-404-img">
                <img src="{{ asset('assets/img/404-img.png') }}" alt="Image">
            </div>
            <h2 class="ul-section-title">Oups! Quelque chose s'est mal passé</h2>
            <p>Désolé, mais la page que vous recherchez n'est pas disponible actuellement</p>
            <a href="{{ route('home') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Retour à l'accueil</a>
        </div>
    </section>
    <!-- 404 SECTION END -->
@endsection 