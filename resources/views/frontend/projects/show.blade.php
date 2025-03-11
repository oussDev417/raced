@extends('frontend.layouts.master')

@section('title', $project->title ?? 'Détail du projet')

@section('content')

<!-- Page Heading Section Start -->	
<div class="pagehding-sec">
		<div class="images-overlay"></div>		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-heading">
						<h1>{{ $project->title ?? 'Détail du projet' }}</h1>
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
							<li><a href="{{ route('projects.index') }}">Nos projets</a></li>
							<li>{{ $project->title ?? 'Détail du projet' }}</li>
						</ul>
					</div>
				</div>	
			</div>
		</div>
	</div>
<!-- Breadcrumb Area End -->

<!-- Project Detail Start -->
<div class="blog-detail-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-detail-item shadow-lg rounded overflow-hidden" style="border: 1px solid #eee;">
                    <div class="blog-detail-photo position-relative">
                        @if($project->image)
                            <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" class="img-fluid w-100">
                        @else
                            <img src="{{ asset('images/projects/default.jpg') }}" alt="{{ $project->title }}" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
                        @endif
                        <div class="overlay-gradient"></div>
                    </div>
                    <div class="blog-detail-text p-5">
                        <div class="blog-detail-info mb-4">
                            @if($project->created_at)
                                <span class="badge p-2" style="background-color: #042a41;"><i class="far fa-calendar-alt me-2"></i> Début: {{ \Carbon\Carbon::parse($project->created_at)->format('d/m/Y') }}</span>
                            @endif
                        </div>
                        <div class="blog-detail-content">
                            <h3 class="mb-4" style="color: #042a41; font-weight: 600;">{{ $project->title }}</h3>
                            <div class="content-text" style="color: #555; line-height: 1.8;">
                                {!! $project->description !!}
                            </div>
                        </div>
                        
                        <style>
                            .share-buttons {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                gap: 1rem;
                            }
                            .share-button {
                                width: 40px;
                                height: 40px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                transition: transform 0.2s;
                            }
                            .share-button:hover {
                                transform: translateY(-3px);
                            }
                        </style>
                        <!-- Share buttons -->
                        <div class="blog-detail-share border-top border-bottom py-4 my-5">
                            <h4 class="mb-3 text-center" style="color: #042a41;">Partager ce projet:</h4>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn rounded-circle share-button" style="background-color: #8DC63F; color: white;"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->title) }}" target="_blank" class="btn rounded-circle share-button" style="background-color: #8DC63F; color: white;"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($project->title) }}" target="_blank" class="btn rounded-circle share-button" style="background-color: #8DC63F; color: white;"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://wa.me/?text={{ urlencode($project->title . ' ' . request()->url()) }}" target="_blank" class="btn rounded-circle share-button" style="background-color: #8DC63F; color: white;"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                        
                        <!-- Call to action -->
                        <div class="project-cta mt-5 rounded p-4" style="background-color: #f8f9fa;">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="mb-2" style="color: #042a41;">Soutenez ce projet</h4>
                                    <p class="mb-md-0" style="color: #555;">Vous souhaitez contribuer à la réussite de ce projet ? Faites un don ou devenez bénévole dès maintenant.</p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <a href="{{ route('donation') }}" class="btn btn-lg" style="background-color: #8DC63F; color: white;">Faire un don</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    <style>
                        .recent-project-item {
                            display: flex;
                            align-items: center;
                            padding: 10px 0;
                            border-bottom: 1px solid #eee;
                        }
                        .recent-project-image {
                            flex: 0 0 80px;
                            margin-right: 15px;
                        }
                        .recent-project-content {
                            flex: 1;
                        }
                        .recent-project-title {
                            color: #042a41;
                            font-weight: bold;
                            text-decoration: none;
                            margin-bottom: 5px;
                            display: block;
                        }
                        .recent-project-date {
                            color: #6c757d;
                            font-size: 0.875rem;
                        }
                    </style>
                    
                    <!-- Recent Projects -->
                    @if(isset($recentProjects) && count($recentProjects) > 0)
                        <div class="sidebar-item bg-white shadow rounded overflow-hidden mb-4">
                            <div class="sidebar-title p-3" style="background-color: #042a41;">
                                <h3 class="h5 mb-0 text-white" style="color: #fff; font-weight: bold;">Projets récents</h3>
                            </div>
                            <div class="sidebar-body p-3">
                                <ul class="list-unstyled mb-0">
                                    @foreach($recentProjects as $recentProject)
                                        <li class="recent-project-item">
                                            <div class="recent-project-image">
                                                @if($recentProject->image)
                                                    <img src="{{ asset($recentProject->image) }}" alt="{{ $recentProject->title }}" class="rounded-3" width="80" height="80" style="object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('images/projects/default-thumb.jpg') }}" alt="{{ $recentProject->title }}" class="rounded-3" width="80" height="80" style="object-fit: cover;">
                                                @endif
                                            </div>
                                            <div class="recent-project-content">
                                                <a href="{{ route('projects.show', $recentProject->slug) }}" class="recent-project-title">{{ $recentProject->title }}</a>
                                                <span class="recent-project-date">{{ \Carbon\Carbon::parse($recentProject->created_at)->format('d/m/Y') }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Contact Box -->
                    <div class="sidebar-item bg-white shadow rounded overflow-hidden">
                        <div class="sidebar-title p-3" style="background-color: #042a41;">
                            <h3 class="h5 mb-0 text-white" style="color: #fff; font-weight: bold;">Besoin d'informations?</h3>
                        </div>
                        <div class="sidebar-body p-4">
                            <div class="sidebar-contact text-center">
                                <p class="mb-4" style="color: #555;">Pour plus d'informations sur ce projet, n'hésitez pas à nous contacter.</p>
                                <div class="sidebar-contact-btn">
                                    <a href="{{ route('contact') }}" class="btn btn-lg w-100" style="background-color: #8DC63F; color: white;">Contactez-nous</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Project Detail End -->
@endsection 