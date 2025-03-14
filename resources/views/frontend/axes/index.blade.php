@extends('frontend.layouts.master')

@section('title', 'Nos opportunités')

@section('content')
<!-- BREADCRUMBS SECTION START -->
<section class="ul-breadcrumb ul-section-spacing">
    <div class="ul-container">
        <h2 class="ul-breadcrumb-title">Nos opportunités</h2>
        <ul class="ul-breadcrumb-nav">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li>Nos opportunités</li>
        </ul>
    </div>
</section>
<!-- BREADCRUMBS SECTION END -->

<!-- Axes SECTION START -->
<section class="ul-section-spacing overflow-hidden">
    <div class="ul-container">
        <div class="row row-cols-md-3 row-cols-2 row-cols-xxs-1 ul-bs-row">
            @foreach($axes as $axe)
            <!-- single axe -->
            <div class="col">
                <div class="ul-service ul-service--inner">
                    <div class="ul-service-img">
                        <img src="{{ asset('storage/axes/' . $axe->image) }}" alt="{{ $axe->title }}">
                    </div>
                    <div class="ul-service-txt">
                        <h3 class="ul-service-title"><a href="{{ route('axes.show', $axe->slug) }}">{{ $axe->title }}</a></h3>
                        <p class="ul-service-descr">{{ Str::limit($axe->short_description, 100) }}</p>
                        <a href="{{ route('axes.show', $axe->slug) }}" class="ul-service-btn"><i class="flaticon-up-right-arrow"></i> Voir détails</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Axes SECTION END -->


@endsection
