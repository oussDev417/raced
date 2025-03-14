@extends('frontend.layouts.master')

@section('title', 'Détails de l\'opportunité')

@section('content')
<!-- BREADCRUMBS SECTION START -->
<section class="ul-breadcrumb ul-section-spacing">
    <div class="ul-container">
        <h2 class="ul-breadcrumb-title">Détails de l'opportunité</h2>
        <ul class="ul-breadcrumb-nav">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li>Détails de l'opportunité</li>
        </ul>
    </div>
</section>
<!-- BREADCRUMBS SECTION END -->

<!-- SECTION DÉTAILS DE L'AXE -->
<section class="ul-service-details ul-section-spacing">
    <div class="ul-container">
        <div>
            <div class="ul-service-details-img">
                <img src="{{ asset('storage/axes/' . $axe->image) }}" alt="{{ $axe->title }}">
            </div>
            <div class="ul-service-details-txt">
                <h2 class="ul-service-details-title">{{ $axe->title }}</h2>
                <p class="ul-service-details-descr">{{ $axe->short_description }}</p>

                <div class="ul-service-details-inner-block">
                    <h3 class="ul-service-details-inner-title">Description détaillée</h3>
                    <p class="ul-service-details-descr">{!! $axe->description !!}</p>
                </div>
            </div>

            @if(isset($axe->video_url))
            <div class="ul-service-details-video-cover">
                <img src="{{ asset('storage/axes/' . $axe->image) }}" alt="Vidéo de présentation">
                <a href="{{ $axe->video_url }}" data-fslightbox="Video">Voir la vidéo</a>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- FIN SECTION DÉTAILS DE L'AXE -->
@endsection
