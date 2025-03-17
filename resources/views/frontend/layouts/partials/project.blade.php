<!-- PROJECTS SECTION START -->
<section class="ul-projects ul-section-spacing">
    <div class="ul-container">
        <div class="ul-section-heading text-center justify-content-center">
            <div>
                <span class="ul-section-sub-title">Nos réalisations</span>
                <h2 class="ul-section-title">Nos projets pour améliorer la vie des enfants</h2>
            </div>
        </div>

        @if(isset($projects) && count($projects) > 0)
        <div class="row ul-bs-row justify-content-center">
            @foreach($projects->take(4) as $key => $project)
                @if($key == 0 || $key == 3)
                <div class="col-lg-8 col-md-6 col-10 col-xxs-12">
                    <div class="ul-project">
                        <div class="ul-project-img">
                            <img src="{{ asset($project->image ?? 'assets/img/project-1.jpg') }}" alt="{{ $project->title }}">
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
                @else
                <div class="col-lg-4 col-md-6 col-10 col-xxs-12">
                    <div class="ul-project ul-project--sm">
                        <div class="ul-project-img">
                            <img src="{{ asset($project->image ?? 'assets/img/project-2.jpg') }}" alt="{{ $project->title }}">
                        </div>
                        <div class="ul-project-txt">
                            <div>
                                <h3 class="ul-project-title"><a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a></h3>
                                <p class="ul-project-descr">{{ Str::limit(strip_tags($project->short_description), 40) }}</p>
                            </div>
                            <a href="{{ route('projects.show', $project->slug) }}" class="ul-project-btn"><i class="flaticon-up-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        @else
        <div class="row ul-bs-row justify-content-center">
            <div class="col-md-12">
                <p class="text-center">Aucun projet disponible pour le moment.</p>
            </div>
        </div>
        @endif
        
        <div class="text-center mt-4">
            <a href="{{ route('projects.index') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Voir tous nos projets</a>
        </div>
    </div>
</section>
<!-- PROJECTS SECTION END -->