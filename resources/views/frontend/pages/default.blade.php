@extends('frontend.layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@push('styles')
<style>
    /* Styles pour le contenu de l'éditeur */
    .page-content {
        margin: 2rem 0;
    }
    
    .page-content h1, .page-content h2, .page-content h3, 
    .page-content h4, .page-content h5, .page-content h6 {
        margin-bottom: 1rem;
        margin-top: 1.5rem;
    }
    
    .page-content p {
        margin-bottom: 1rem;
        line-height: 1.6;
    }
    
    .page-content ul, .page-content ol {
        margin-left: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .page-content img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
    }
    
    .page-content blockquote {
        border-left: 4px solid #ccc;
        padding-left: 1rem;
        margin-left: 0;
        font-style: italic;
    }
    
    .page-content a {
        color: #0066cc;
        text-decoration: underline;
    }
    
    .page-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
    }
    
    .page-content table td, .page-content table th {
        border: 1px solid #ddd;
        padding: 0.5rem;
    }
</style>
@endpush

@section('content')
    <!-- BREADCRUMBS SECTION START -->
    @if(!$page->is_home)
    <section class="ul-breadcrumb ul-section-spacing">
        <div class="ul-container">
            <h2 class="ul-breadcrumb-title">{{ $page->title }}</h2>
            <ul class="ul-breadcrumb-nav">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li><span class="separator"><i class="flaticon-right"></i></span></li>
                <li>{{ $page->title }}</li>
            </ul>
        </div>
    </section>
    @endif
    <!-- BREADCRUMBS SECTION END -->

    <div class="ul-container">
        <div class="page-content">
            {!! $page->content !!}
        </div>
    </div>

    <!-- SECTIONS DYNAMIQUES -->
    @foreach($pageSections as $pageSection)
        <x-dynamic-section :page-section="$pageSection" />
    @endforeach
@endsection