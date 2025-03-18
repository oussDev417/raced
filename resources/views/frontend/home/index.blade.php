@extends('frontend.layouts.master')

@section('title', isset($settings) ? $settings->site_name : 'ONG Carrefour Jeunesse Afrique')

@section('content')
<!-- BANNER SECTION START -->
@include('frontend.layouts.partials.slider')
<!-- BANNER SECTION END -->

<!-- FEATURES SECTION START -->
@include('frontend.layouts.partials.feature')
<!-- FEATURES SECTION END -->


<!-- ABOUT SECTION START -->
@include('frontend.layouts.partials.about')
<!-- ABOUT SECTION END -->

<!-- OPPORTUNITES SECTION START -->
@include('frontend.layouts.partials.opportunites')
<!-- OPPORTUNITES SECTION END -->


<!-- PROJETS SECTION START -->
@include('frontend.layouts.partials.project')
<!-- PROJETS SECTION END -->

<!-- BENEVOL SECTION START -->
@include('frontend.layouts.partials.benevole')
<!-- BENEVOL SECTION END -->

<!-- ACTUALITES SECTION START -->
@include('frontend.layouts.partials.new')
<!-- ACTUALITES SECTION END -->

<!-- Stats -->
@include('frontend.layouts.partials.stats')	

<!-- Partenaires -->
@include('frontend.layouts.partials.partners')

<!-- SECTIONS DYNAMIQUES SUPPLÉMENTAIRES -->
@if(isset($pageSections) && $pageSections->count() > 0)
    @foreach($pageSections as $pageSection)
        <!-- Ne pas re-afficher les sections qui sont déjà incluses statiquement -->
        @php
            $staticSections = ['slider', 'feature', 'about', 'opportunites', 'project', 'benevole', 'new', 'stats', 'partners'];
            $shouldShow = !in_array($pageSection->section->blade_component, $staticSections);
        @endphp
        
        @if($shouldShow)
            <x-dynamic-section :page-section="$pageSection" />
        @endif
    @endforeach
@endif
@endsection