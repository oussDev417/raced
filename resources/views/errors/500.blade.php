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

@section('title', 'Erreur serveur')
@section('meta_description', 'Erreur serveur - RACED ONG')
@section('meta_keywords', 'erreur, 500, serveur, RACED ONG')

@section('content')
    <!-- BREADCRUMBS SECTION START -->
    <section class="ul-breadcrumb ul-section-spacing">
        <div class="ul-container">
            <h2 class="ul-breadcrumb-title">Erreur Serveur</h2>
            <ul class="ul-breadcrumb-nav">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li><span class="separator"><i class="flaticon-right"></i></span></li>
                <li>Erreur</li>
            </ul>
        </div>
    </section>
    <!-- BREADCRUMBS SECTION END -->

    <!-- 500 SECTION START -->
    <section class="ul-404 ul-section-spacing text-center">
        <div class="ul-404-container">
            <div class="ul-404-img">
                <img src="{{ asset('assets/img/404-img.png') }}" alt="Image">
            </div>
            <h2 class="ul-section-title">Oups! Une erreur est survenue sur notre serveur</h2>
            <p>Nous sommes désolés pour ce désagrément. Notre équipe technique a été informée et travaille à résoudre ce problème.</p>
            <a href="{{ route('home') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Retour à l'accueil</a>
        </div>
    </section>
    <!-- 500 SECTION END -->
@endsection 