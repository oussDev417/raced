@extends('frontend.layouts.master')

@section('title', $project->title ?? 'Détail du projet')

@section('content')
<!-- BREADCRUMBS SECTION START -->
<section class="ul-breadcrumb ul-section-spacing">
    <div class="ul-container">
        <h2 class="ul-breadcrumb-title">{{ $project->title ?? 'Détail du projet' }}</h2>
        <ul class="ul-breadcrumb-nav">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li><a href="{{ route('projects.index') }}">Nos projets</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li>{{ $project->title ?? 'Détail du projet' }}</li>
        </ul>
    </div>
</section>
<!-- BREADCRUMBS SECTION END -->

<div class="ul-container ul-section-spacing">
    <div class="ul-project-details-img-slider swiper">
        <div class="swiper-wrapper">
            <!-- single slide -->
            <div class="swiper-slide">
                <div>
                    @if($project->image)
                        <img src="{{ asset($project->image) }}" alt="{{ $project->title }}">
                     @endif
                </div>
            </div>
            <div class="swiper-slide">
                <div>
                    <img src="https://images.unsplash.com/photo-1584592487914-a29c64f25887?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="{{ $project->title }}">
                </div>
            </div>
            <div class="swiper-slide">
                <div>
                    <img src="https://images.unsplash.com/photo-1547496614-54ff387d650a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="{{ $project->title }}">
                </div>
            </div>
            <!-- Si vous avez plusieurs images, vous pouvez les ajouter ici -->
        </div>

        <div class="ul-project-details-slider-nav ul-slider-nav">
            <button class="prev"><i class="flaticon-back"></i></button>
            <button class="next"><i class="flaticon-next"></i></button>
        </div>
    </div>

    <div class="row gx-5 gy-4 flex-column-reverse flex-lg-row">
        <!-- contenu détaillé du projet -->
        <div class="col-md-8">
            <div class="ul-event-details">
                <h2 class="ul-event-details-title">{{ $project->title }}</h2>
                <p class="ul-event-details-descr">{!! $project->short_description ?? '' !!}</p>
                <div class="ul-event-details-content">
                    {!! $project->description !!}
                </div>
                
                <!-- Call to action -->
                <div class="mt-5">
                    <h3 class="ul-event-inner-title">Soutenez ce projet</h3>
                    <p>Vous souhaitez contribuer à la réussite de ce projet ? Faites un don ou devenez bénévole dès maintenant.</p>
                    <a href="{{ route('donation') }}" class="ul-btn ul-btn-primary">Faire un don</a>
                </div>
            </div>
        </div>

        <!-- sidebar -->
        <div class="col-md-4">
            <div class="ul-project-details-infos">
                <h4 class="ul-project-details-infos-title">Informations du projet</h4>
                <ul class="ul-project-details-infos-list">
                    @if($project->category)
                    <li><span class="key">CATÉGORIE</span>:<span class="value">{{ $project->category->name ?? 'Non spécifiée' }}</span></li>
                    @endif
                    <li><span class="key">AUTEUR</span>:<span class="value">{{ $project->author ?? 'RACED ONG' }}</span></li>
                    @if($project->tags)
                    <li><span class="key">TAGS</span>:<span class="value">{{ $project->tags ?? 'Non spécifiés' }}</span></li>
                    @endif
                    @if($project->budget)
                    <li><span class="key">BUDGET</span>:<span class="value">{{ $project->budget ?? 'Non spécifié' }}</span></li>
                    @endif
                    <li><span class="key">DATE</span>:<span class="value">{{ $project->created_at ? \Carbon\Carbon::parse($project->created_at)->format('d F, Y') : 'Non spécifiée' }}</span></li>
                </ul>

                <div class="ul-footer-socials ul-project-details-infos-shares">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"><i class="flaticon-facebook"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->title) }}" target="_blank"><i class="flaticon-twitter"></i></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($project->title) }}" target="_blank"><i class="flaticon-linkedin-big-logo"></i></a>
                    <a href="https://wa.me/?text={{ urlencode($project->title . ' ' . request()->url()) }}" target="_blank"><i class="flaticon-youtube"></i></a>
                </div>
            </div>
            
            <!-- Projets récents -->
            @if(isset($recentProjects) && count($recentProjects) > 0)
            <div class="ul-project-details-infos mt-4">
                <h4 class="ul-project-details-infos-title">Projets récents</h4>
                <ul class="ul-project-details-infos-list">
                    @foreach($recentProjects as $recentProject)
                    <li>
                        <a href="{{ route('projects.show', $recentProject->slug) }}" class="d-flex align-items-center py-2">
                            <div class="me-3" style="width: 60px; height: 60px; overflow: hidden; border-radius: 8px;">
                                @if($recentProject->image)
                                <img src="{{ asset($recentProject->image) }}" alt="{{ $recentProject->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                @else
                                <img src="{{ asset('assets/img/project-1.jpg') }}" alt="{{ $recentProject->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                @endif
                            </div>
                            <div>
                                <span class="d-block text-white">{{ $recentProject->title }}</span>
                                <small class="text-white">{{ \Carbon\Carbon::parse($recentProject->created_at)->format('d/m/Y') }}</small>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Contact -->
            <div class="ul-project-details-infos mt-4">
                <h4 class="ul-project-details-infos-title">Besoin d'informations?</h4>
                <p class="mb-3">Pour plus d'informations sur ce projet, n'hésitez pas à nous contacter.</p>
                <a href="{{ route('contact') }}" class="ul-btn ul-btn-primary w-100 text-center">Contactez-nous</a>
            </div>
        </div>
    </div>

    <div class="ul-project-details-nav">
        <a href="#"><i class="flaticon-back"></i> <span>Projet précédent</span></a>
        <a href="#"><i class="flaticon-next"></i> <span>Projet suivant</span></a>
    </div>
</div>
@endsection 