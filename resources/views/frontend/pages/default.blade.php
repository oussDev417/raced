@extends('frontend.layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

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

    <!-- SECTIONS DYNAMIQUES -->
    @foreach($pageSections as $pageSection)
        <x-dynamic-section :page-section="$pageSection" />
    @endforeach
@endsection 