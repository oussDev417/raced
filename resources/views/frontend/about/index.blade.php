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

<!-- TEAM SECTION START -->
<section class="ul-team ul-section-spacing">
    <div class="ul-container">
        <!-- Heading -->
        <div class="ul-section-heading justify-content-between">
            <div class="left">
                <span class="ul-section-sub-title">Notre équipe</span>
                <h2 class="ul-section-title">Nous sommes une équipe de professionnels</h2>
            </div>
            <div>
                <a href="{{ route('team') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Voir tous nos membres</a>
            </div>
        </div>

        <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-team-row justify-content-center">
            <!-- single member -->
            @if(isset($equipes) && $equipes->count() > 0)
                @foreach($equipes->take(4) as $member)
                    <div class="col">
                        <div class="ul-team-member">
                            <div class="ul-team-member-img">
                                @if($member->image)
                                    <img src="{{ asset('storage/equipes/' . $member->image) }}" alt="{{ $member->name }}">
                                @else
                                    <img src="{{ asset('img/equipe/default.jpg') }}" alt="{{ $member->name }}">
                                @endif
                                <div class="ul-team-member-socials">
                                    @if(isset($member->linkedin))
                                        <a href="{{ $member->linkedin }}" target="_blank"><i class="flaticon-linkedin-big-logo"></i></a>
                                    @endif
                                    @if($member->phone)
                                        <a href="tel:{{ $member->phone }}"><i class="flaticon-telephone-call"></i></a>
                                    @endif
                                    @if($member->email)
                                        <a href="mailto:{{ $member->email }}"><i class="flaticon-email"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="ul-team-member-info">
                                <h3 class="ul-team-member-name">{{ $member->name }}</h3>
                                <p class="ul-team-member-designation">{{ $member->position }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- TEAM SECTION END -->

<!-- TESTIMONIAL SECTION START -->
<section class="ul-testimonial-2 ul-section-spacing">
    <div class="ul-container wow animate__fadeInUp">
        <div class="ul-section-heading">
            <div>
                <span class="ul-section-sub-title">Témoignages</span>
                <h2 class="ul-section-title">Ce que les gens disent de nous</h2>
            </div>
            <a href="#" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Tous les témoignages</a>
        </div>

        <div class="row ul-testimonial-2-row gy-4">
            <!-- card -->
            <div class="col-md-4">
                <div class="ul-testimonial-2-overview">
                    <span class="rating">4.9</span>
                    <div class="ul-testimonial-2-overview-stars">
                        <i class="flaticon-star"></i>
                        <i class="flaticon-star"></i>
                        <i class="flaticon-star"></i>
                        <i class="flaticon-star"></i>
                        <i class="flaticon-star-1"></i>
                    </div>
                    <span class="ul-testimonial-2-overview-title">5 étoiles</span>
                    <p class="ul-testimonial-2-overview-descr">Découvrez ce que nos clients et partenaires disent de notre travail et de notre engagement.</p>
                    <div class="ul-testimonial-2-overview-reviewers">
                        @if(isset($testimonials) && $testimonials->count() > 0)
                            @foreach($testimonials->take(4) as $reviewer)
                                <img src="{{ asset('storage/testimonials/' . $reviewer->image) }}" alt="{{ $reviewer->name }}">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- txt -->
            <div class="col-md-8">
                <div class="ul-testimonial-2-slider swiper">
                    <div class="swiper-wrapper">
                        @if(isset($testimonials) && $testimonials->count() > 0)
                            @foreach($testimonials as $testimonial)
                                <!-- single slide -->
                                <div class="swiper-slide">
                                    <div class="ul-review ul-review-2">
                                        <span class="icon"><i class="flaticon-quote-1"></i></span>
                                        <p class="ul-review-descr">{{ $testimonial->message }}</p>
                                        <div class="ul-review-bottom">
                                            <div class="ul-review-reviewer">
                                                <div class="reviewer-image">
                                                    <img src="{{ asset('storage/testimonials/' . $testimonial->image) }}" alt="{{ $testimonial->name }}">
                                                </div>
                                                <div>
                                                    <h3 class="reviewer-name">{{ $testimonial->name }}</h3>
                                                    <span class="reviewer-role">{{ $testimonial->position }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="ul-testimonial-2-slider-nav">
                        <button class="prev"><i class="flaticon-back"></i></button>
                        <button class="next"><i class="flaticon-next"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- TESTIMONIAL SECTION END -->


<!-- PARTNERS SECTION START -->
 @include('frontend.layouts.partials.partners')

@endsection 