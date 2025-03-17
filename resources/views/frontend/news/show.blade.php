@extends('frontend.layouts.master')

@section('title', $post->title ?? 'Détail de l\'actualité')

@section('content')

	<!-- BREADCRUMBS SECTION START -->
    <section class="ul-breadcrumb ul-section-spacing">
        <div class="ul-container">
            <h2 class="ul-breadcrumb-title">Details de l'actualité</h2>
            <ul class="ul-breadcrumb-nav">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li><span class="separator"><i class="flaticon-right"></i></span></li>
                <li>Details de l'actualité</li>
            </ul>
        </div>
    </section>
    <!-- BREADCRUMBS SECTION END -->

<!-- BLOG SECTION START -->
<div class="ul-section-spacing">
    <div class="ul-container">
        <div class="row ul-bs-row gy-5 flex-column-reverse flex-md-row">
            <!-- sidebar -->
            <div class="col-lg-4 col-md-5">
                <div class="ul-inner-sidebar">
                    <!-- single widget /search -->
                    <div class="ul-inner-sidebar-widget ul-inner-sidebar-search">
                        <h3 class="ul-inner-sidebar-widget-title">Recherche</h3>
                        <div class="ul-inner-sidebar-widget-content">
                            <form action="{{ route('news.index') }}" method="GET" class="ul-blog-search-form">
                                <input type="search" name="search" id="ul-blog-search" placeholder="Rechercher ici" value="{{ request('search') }}">
                                <button type="submit"><span class="icon"><i class="flaticon-search"></i></span></button>
                            </form>
                        </div>
                    </div>

                    <!-- single widget / Categories -->
                    @if(isset($categories) && count($categories) > 0)
                    <div class="ul-inner-sidebar-widget categories">
                        <h3 class="ul-inner-sidebar-widget-title">Catégories</h3>
                        <div class="ul-inner-sidebar-widget-content">
                            <div class="ul-inner-sidebar-categories">
                                @foreach($categories as $category)
                                    <a href="{{ route('news.index', ['category' => $category->id]) }}">{{ $category->title }} <span>({{ $category->news_count ?? 0 }})</span></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- single widget / Recent Posts -->
                    @if(isset($recentNews) && count($recentNews) > 0)
                    <div class="ul-inner-sidebar-widget posts">
                        <h3 class="ul-inner-sidebar-widget-title">Articles Récents</h3>
                        <div class="ul-inner-sidebar-widget-content">
                            <div class="ul-inner-sidebar-posts">
                                @foreach($recentNews as $recentPost)
                                <!-- single post -->
                                <div class="ul-inner-sidebar-post">
                                    <div class="img">
                                        @if($recentPost->thumbnail)
                                            <img src="{{ asset($recentPost->thumbnail) }}" alt="{{ $recentPost->title }}">
                                        @else
                                            <img src="assets/img/blog-2.jpg" alt="Post Image">
                                        @endif
                                    </div>

                                    <div class="txt">
                                        <h4 class="title"><a href="{{ route('news.show', $recentPost->slug) }}">{{ $recentPost->title }}</a></h4>
                                        <span class="date"><span>{{ $recentPost->created_at->format('d M, Y') }}</span></span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- left/blog details -->
            <div class="col-lg-8 col-md-7">
                <div class="ul-blog-details ul-blog-inner mb-0">
                    <div class="ul-blog-2 ul-blog-inner">
                        @if($news->thumbnail)
                        <div class="ul-blog-img"><img src="{{ asset($news->thumbnail) }}" alt="{{ $news->title }}"></div>
                        @endif
                        <div class="ul-blog-txt">
                            <div class="ul-blog-infos">
                                <!-- single info -->
                                <div class="ul-blog-info">
                                    <span class="icon"><i class="flaticon-account"></i></span>
                                    <span class="text">Par Admin</span>
                                </div>
                                <!-- single info -->
                                @if($news->category)
                                <div class="ul-blog-info">
                                    <span class="icon"><i class="flaticon-price-tag"></i></span>
                                    <span class="text">{{ $news->category->title }}</span>
                                </div>
                                @endif
                                <!-- single info -->
                                <div class="ul-blog-info">
                                    <span class="icon"><i class="flaticon-calendar"></i></span>
                                    <span class="text">{{ $news->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <h2 class="ul-blog-title">{{ $news->title }}</h2>
                            <div class="ul-donation-details-summary-txt ul-blog-details-txt">
                                {!! $news->description !!}
                            </div>
                        </div>
                    </div>

                    <!-- actions -->
                    <div class="ul-blog-details-actions">
                        <!-- tags -->
                        @if($news->category)
                        <div class="tags-wrapper">
                            <h4 class="actions-title">Catégorie: </h4>
                            <div class="ul-blog-sidebar-tags tags">
                                <a href="{{ route('news.index', ['category' => $news->category->id]) }}">{{ $news->category->title }}</a>
                            </div>
                        </div>
                        @endif

                        <!-- share -->
                        <div class="shares-wrapper">
                            <h4 class="actions-title">Partager: </h4>
                            <div class="share-options">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"><i class="flaticon-facebook"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" target="_blank"><i class="flaticon-twitter"></i></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($news->title) }}" target="_blank"><i class="flaticon-linkedin-big-logo"></i></a>
                                <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}" target="_blank"><i class="flaticon-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BLOG SECTION END -->

@endsection 