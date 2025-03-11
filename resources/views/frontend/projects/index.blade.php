@extends('frontend.layouts.master')

@section('title', 'Nos projets')

@section('content')

<!-- Page Heading Section Start -->	
<div class="pagehding-sec">
    <div class="images-overlay"></div>		
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>Nos projets</h1>
                </div>
            </div>				
        </div>
    </div>
</div>
<!-- Page Heading Section End -->	

<!-- Page Heading Section Start -->	
<div class="breadcrumb-sec">	
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-left">
                    <ul>
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="#">Nos projets</a></li>
                    </ul>
                </div>
            </div>	
        </div>
    </div>
</div>
<!-- Page Heading Section End -->

<!-- Recent Causes Section Start -->	
<div class="recent-causes-sec pt-100">
    <div class="container">		
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title">
                    <h1>Nos projets</h1>
                    <div class="border-shape"></div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(isset($projects) && count($projects) > 0)
                @foreach($projects as $project)
                    <div class="col-md-4">
                        <div class="single-causes">
                            <div class="causes-thumb">
                                @if($project->image)
                                    <img src="{{ asset($project->image) }}" alt="{{ $project->title }}"/>
                                @endif
                                <div class="causes2-thumb-overlay">
                                    <ul>
                                        <li><a href="{{ route('projects.show', $project->slug) }}"><i class="fa fa-unlink"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single-causes-text">
                                <h2><a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a></h2>
                                <p>{{ Str::limit(strip_tags($project->short_description), 100) }}</p>
                                <div class="project-meta">
                                    @if($project->created_at)
                                        <span class="project-date">{{ \Carbon\Carbon::parse($project->created_at)->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="col-md-12">
                    <div class="pagination-area">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- Project Area End -->

@endsection 