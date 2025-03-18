@extends('frontend.layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
    <!-- BREADCRUMBS SECTION START -->
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
    <!-- BREADCRUMBS SECTION END -->

    <div class="ul-container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <!-- SECTIONS DYNAMIQUES -->
                @foreach($pageSections as $pageSection)
                    <x-dynamic-section :page-section="$pageSection" />
                @endforeach
            </div>
            
            <div class="col-lg-4 col-md-5">
                <!-- SIDEBAR -->
                <div class="ul-blog-sidebar">
                    <!-- RECHERCHE -->
                    <div class="ul-blog-sidebar-widget">
                        <h3 class="ul-blog-sidebar-widget-title">Recherche</h3>
                        <form action="#" class="ul-blog-sidebar-search">
                            <input type="search" name="search" placeholder="Rechercher...">
                            <button type="submit"><i class="flaticon-search"></i></button>
                        </form>
                    </div>
                    
                    <!-- CATÉGORIES -->
                    <div class="ul-blog-sidebar-widget">
                        <h3 class="ul-blog-sidebar-widget-title">Catégories</h3>
                        <div class="ul-blog-sidebar-categories">
                            <a href="#" class="ul-blog-sidebar-category">Actualités</a>
                            <a href="#" class="ul-blog-sidebar-category">Projets</a>
                            <a href="#" class="ul-blog-sidebar-category">Événements</a>
                        </div>
                    </div>
                    
                    <!-- ARTICLES RÉCENTS -->
                    <div class="ul-blog-sidebar-widget">
                        <h3 class="ul-blog-sidebar-widget-title">Articles récents</h3>
                        <div class="ul-blog-sidebar-posts">
                            <!-- POSTS WILL BE DYNAMICALLY INSERTED HERE -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 