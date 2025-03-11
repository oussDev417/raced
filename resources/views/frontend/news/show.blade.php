@extends('frontend.layouts.master')

@section('title', $post->title ?? 'Détail de l\'actualité')

@section('content')

<!-- Page Heading Section Start -->	
<div class="pagehding-sec">
		<div class="images-overlay"></div>		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-heading">
						<h1>{{ $news->title ?? 'Détail de l\'actualité' }}</h1>
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
							<li><a href="{{ route('news.index') }}">Actualités</a></li>
							<li>{{ $news->title ?? 'Détail de l\'actualité' }}</li>
						</ul>
					</div>
				</div>	
			</div>
		</div>
	</div>
<!-- Breadcrumb Area End -->

<!-- Blog Detail Start -->
<div class="blog-detail-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-detail-item shadow-lg rounded overflow-hidden" style="border: 1px solid #eee;">
                    <div class="blog-detail-photo position-relative">
                        @if($news->thumbnail)
                            <img src="{{ asset($news->thumbnail) }}" alt="{{ $news->title }}" class="img-fluid w-100">
                        @endif
                        <div class="overlay-gradient"></div>
                    </div>
                    <div class="blog-detail-text p-5">
                        <div class="blog-detail-info mb-4">
                            <span class="badge p-2" style="background-color: #042a41;">
                                <i class="far fa-calendar-alt me-2"></i> {{ $news->created_at->format('d/m/Y') }}
                            </span>
                                <span class="badge p-2" style="background-color: #042a41;">
                                    <i class="fas fa-user me-2"></i> Par Admin CJA ONG
                                </span>
                            @if($news->category)
                                <span class="badge p-2" style="background-color: #042a41;">
                                    <i class="fas fa-folder me-2"></i> {{ $news->category->title }}
                                </span>
                            @endif
                        </div>
                        <div class="blog-detail-content">
                            <h3 class="mb-4" style="color: #042a41; font-weight: 600;">{{ $news->title }}</h3>
                            <div class="content-text" style="color: #000; line-height: 1.8;">
                                {!! $news->description !!}
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
                            <h4 class="mb-3 text-center" style="color: #042a41;">Partager cet article:</h4>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn rounded-circle share-button" style="background-color: #8DC63F; color: white;"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" target="_blank" class="btn rounded-circle share-button" style="background-color: #8DC63F; color: white;"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($news->title) }}" target="_blank" class="btn rounded-circle share-button" style="background-color: #8DC63F; color: white;"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}" target="_blank" class="btn rounded-circle share-button" style="background-color: #8DC63F; color: white;"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    <!-- Search -->
                    <div class="sidebar-item bg-white shadow rounded overflow-hidden mb-4">
                        <div class="sidebar-title p-3">
                            <h3 class="h5 mb-0 text-white" style="color: #042a41; font-weight: 600;">Rechercher</h3>
                        </div>
                        <div class="sidebar-body p-3">
                            <form action="{{ route('news.index') }}" method="GET" class="sidebar-search">
                                <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" class="form-control">
                                <button type="submit" class="btn" style="background-color: #8DC63F; color: white;"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    @if(isset($categories) && count($categories) > 0)
                        <div class="sidebar-item bg-white shadow rounded overflow-hidden mb-4">
                            <div class="sidebar-title p-3" style="color: #042a41;">
                                <h3 class="h5 mb-0 text-white" style="color: #042a41; font-weight: 600;">Catégories</h3>
                            </div>
                            <div class="sidebar-body p-3">
                                <ul class="list-unstyled mb-0">
                                    @foreach($categories as $category)
                                        <li class="border-bottom py-2">
                                            <a href="{{ route('news.index', ['category' => $category->id]) }}" class="d-flex justify-content-between align-items-center text-decoration-none" style="color: #042a41;">
                                                {{ $category->title }}
                                                <span class="badge rounded-pill" style="background-color: #8DC63F;">{{ $category->news_count ?? 0 }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Recent Posts -->
                    @if(isset($recentNews) && count($recentNews) > 0)
                        <div class="sidebar-item bg-white shadow rounded overflow-hidden">
                            <div class="sidebar-title p-3">
                                <h3 class="h5 mb-0 text-white" style="color: #042a41; font-weight: bold; font-size: 20px;">Articles récents</h3>
                            </div>
                            <div class="sidebar-body p-3">
                                <ul class="list-unstyled mb-0">
                                    @foreach($recentNews as $recentPost)
                                        <li class="d-flex align-items-center border-bottom py-3">
                                            <div class="flex-shrink-0">
                                                @if($recentPost->thumbnail)
                                                    <img src="{{ asset($recentPost->thumbnail) }}" alt="{{ $recentPost->title }}" class="rounded" width="80" height="80" style="object-fit: cover;">
                                                @endif
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <a href="{{ route('news.show', $recentPost->slug) }}" class="text-decoration-none" style="color: #042a41;">{{ $recentPost->title }}</a>
                                                <div class="small text-muted mt-1">{{ $recentPost->created_at->format('d/m/Y') }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Detail End -->

@endsection 