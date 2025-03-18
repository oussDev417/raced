@extends('frontend.layouts.master')

@section('title', 'Nos projets')

@section('content')

<!-- BREADCRUMBS SECTION START -->
<section class="ul-breadcrumb ul-section-spacing">
    <div class="ul-container">
        <h2 class="ul-breadcrumb-title">Nos projets</h2>
        <ul class="ul-breadcrumb-nav">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li>Nos projets</li>
        </ul>
    </div>
</section>
<!-- BREADCRUMBS SECTION END -->


<!-- PROJECTS SECTION START -->
<section class="ul-projects ul-section-spacing">
    <div class="ul-container">
        <div class="row ul-bs-row justify-content-center">
            @if(isset($projects) && count($projects) > 0)
                @foreach($projects as $key => $project)
                    @if($key % 3 == 0)
                    <div class="col-lg-8 col-md-6 col-10 col-xxs-12">
                        <div class="ul-project">
                            <div class="ul-project-img">
                                <img src="{{ asset($project->image ?? 'assets/img/project-1.jpg') }}" alt="{{ $project->title }}">
                            </div>
                            <div class="ul-project-txt">
                                <div>
                                    <h3 class="ul-project-title"><a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a></h3>
                                    <p class="ul-project-descr">{{ Str::limit(strip_tags($project->short_description), 100) }}</p>
                                </div>
                                <a href="{{ route('projects.show', $project->slug) }}" class="ul-project-btn"><i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-4 col-md-6 col-10 col-xxs-12">
                        <div class="ul-project ul-project--sm">
                            <div class="ul-project-img">
                                <img src="{{ asset($project->image ?? 'assets/img/project-2.jpg') }}" alt="{{ $project->title }}">
                            </div>
                            <div class="ul-project-txt">
                                <div>
                                    <h3 class="ul-project-title"><a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a></h3>
                                    <p class="ul-project-descr">{{ Str::limit(strip_tags($project->short_description), 60) }}</p>
                                </div>
                                <a href="{{ route('projects.show', $project->slug) }}" class="ul-project-btn"><i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            @else
                <div class="col-md-12">
                    <p class="text-center">Aucun projet disponible pour le moment.</p>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        @if(isset($projects) && method_exists($projects, 'links'))
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    {{ $projects->links() }}
                </div>
            </div>
        @endif
    </div>
</section>
<!-- PROJECTS SECTION END -->

<!-- DYNAMIC SECTIONS START -->
@if(isset($pageSections) && count($pageSections) > 0)
    @foreach($pageSections as $pageSection)
        <x-dynamic-section :pageSection="$pageSection" />
    @endforeach
@endif
<!-- DYNAMIC SECTIONS END -->

@endsection 