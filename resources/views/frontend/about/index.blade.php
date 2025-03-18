@extends('frontend.layouts.master')

@section('title', 'À propos')

@section('content')

<!-- BREADCRUMBS SECTION START -->
<section class="ul-breadcrumb ul-section-spacing">
    <div class="ul-container">
        <h2 class="ul-breadcrumb-title">À propos</h2>
        <ul class="ul-breadcrumb-nav">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li>À propos</li>
        </ul>
    </div>
</section>
<!-- BREADCRUMBS SECTION END -->

<!-- MISSION, VISION, HISTORY SECTION START -->
<section class="ul-about-tabs ul-events ul-section-spacing pt-0">
    <div class="ul-container">
        <!-- heading -->
        <div class="ul-section-heading align-items-center wow animate__fadeInUp">
            <div class="left">
                <span class="ul-section-sub-title">Tout sur nous</span>
                <h2 class="ul-section-title text-white">@if(isset($about) && $about->title){{ $about->subtitle }}@else Historique @endif</h2>
            </div>
            <a href="{{ route('donation') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Donate Now</a>
                
        </div>

        <!-- tab group -->
        <div class="tab-group">
            <!-- tabs -->
            <div class="ul-about-tabs-wrapper">
                <div id="tab-mission" class="ul-tab ul-about-tab active">
                    <div class="ul-about-tab-img">
                        <img src="{{ asset($about->secondary_image ?? 'img/luc-work.jpeg') }}" alt="Mission">
                    </div>

                    <div class="ul-about-tab-txt">
                        <h3 class="ul-about-tab-title">Nos Missions</h3>
                        <div class="ul-about-tab-descr">
                            @if(isset($about) && $about->mission)
                                {!! $about->mission !!}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- tab 02 / vision -->
                <div id="tab-vision" class="ul-tab ul-about-tab">
                    <div class="ul-about-tab-img">
                        <img src="{{ asset($about->main_image ?? 'img/enfant-maire.jpeg') }}" alt="Vision">
                    </div>

                    <div class="ul-about-tab-txt">
                        <h3 class="ul-about-tab-title">Nos Visions</h3>
                        <div class="ul-about-tab-descr">
                            @if(isset($about) && $about->vision)
                                {!! $about->vision !!}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- tab 03 / history -->
                <div id="tab-history" class="ul-tab ul-about-tab">
                    <div class="ul-about-tab-img">
                        <img src="{{ asset($about->main_image ?? 'img/enfant-maire.jpeg') }}" alt="Histoire">
                    </div>

                    <div class="ul-about-tab-txt">
                        <h3 class="ul-about-tab-title">Notre Histoire</h3>
                        <div class="ul-about-tab-descr">
                            @if(isset($about) && $about->description)
                                {!! $about->description !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-navs ul-about-tabs-nav">
                <button class="tab-nav active" data-tab="tab-mission">Nos Missions</button>
                <button class="tab-nav" data-tab="tab-vision">Nos Visions</button>
                <button class="tab-nav" data-tab="tab-history">Notre Histoire</button>
            </div>
        </div>

        <!-- vectors -->
        <div class="ul-events-vectors">
            <img src="{{ asset('assets/img/about_shape2_1.png') }}" alt="Events Image" class="vector-2">
        </div>
    </div>
</section>
<!-- MISSION, VISION, HISTORY SECTION END -->

<!-- DYNAMIC SECTIONS START -->
@if(isset($pageSections) && count($pageSections) > 0)
    @foreach($pageSections as $pageSection)
        <x-dynamic-section :pageSection="$pageSection" />
    @endforeach
@endif
<!-- DYNAMIC SECTIONS END -->

@endsection 