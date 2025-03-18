@extends('frontend.layouts.master')

@section('title', 'Actualités')

@section('content')

 <!-- BREADCRUMBS SECTION START -->
 <section class="ul-breadcrumb ul-section-spacing">
    <div class="ul-container">
        <h2 class="ul-breadcrumb-title">Nos actualités</h2>
        <ul class="ul-breadcrumb-nav">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li>Nos actualités</li>
        </ul>
    </div>
</section>
<!-- BREADCRUMBS SECTION END -->
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
                            <form action="#" class="ul-blog-search-form">
                                <input type="search" name="blog-search" id="ul-blog-search" placeholder="Rechercher ici">
                                <button type="submit"><span class="icon"><i class="flaticon-search"></i></span></button>
                            </form>
                        </div>
                    </div>

                    <!-- single widget / Categories -->
                    <div class="ul-inner-sidebar-widget categories">
                        <h3 class="ul-inner-sidebar-widget-title">Catégories</h3>
                        <div class="ul-inner-sidebar-widget-content">
                            <div class="ul-inner-sidebar-categories">
                                @if(isset($categories) && count($categories) > 0)
                                    @foreach($categories as $category)
                                        <a href="{{ route('news.category', $category->id) }}">
                                            {{ $category->title }} <span>({{ $category->news->count() }})</span>
                                        </a>
                                    @endforeach
                                @else
                                    <p>Aucune catégorie disponible</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- single widget / Recent Posts -->
                    <div class="ul-inner-sidebar-widget posts">
                        <h3 class="ul-inner-sidebar-widget-title">Articles Récents</h3>
                        <div class="ul-inner-sidebar-widget-content">
                            <div class="ul-inner-sidebar-posts">
                                @if(isset($recentNews) && count($recentNews) > 0)
                                    @foreach($recentNews as $recent)
                                    <!-- single post -->
                                    <div class="ul-inner-sidebar-post">
                                        <div class="img">
                                            @if($recent->thumbnail)
                                                <img src="{{ asset($recent->thumbnail) }}" alt="{{ $recent->title }}">
                                            @else
                                                <img src="assets/img/blog-2.jpg" alt="Post Image">
                                            @endif
                                        </div>

                                        <div class="txt">
                                            <h4 class="title"><a href="{{ route('news.show', $recent->slug) }}">{{ $recent->title }}</a></h4>
                                            <span class="date"><span>{{ $recent->created_at->format('d M, Y') }}</span></span>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <!-- single post -->
                                    <div class="ul-inner-sidebar-post">
                                        <div class="txt">
                                            <h4 class="title">Aucun article récent</h4>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- single widget / Tags -->
                    <div class="ul-inner-sidebar-widget tags">
                        <h3 class="ul-inner-sidebar-widget-title">Tags</h3>
                        <div class="ul-inner-sidebar-widget-content">
                            <div class="ul-inner-sidebar-tags">
                                <a href="#">RACED</a>
                                <a href="#">Développement</a>
                                <a href="#">Éducation</a>
                                <a href="#">Formation</a>
                                <a href="#">Projets</a>
                                <a href="#">Partenariats</a>
                                <a href="#">Événements</a>
                                <a href="#">Actualités</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- left/blogs -->
            <div class="col-lg-8 col-md-7">
                <!-- blogs -->
                <div>
                    @if(isset($news) && count($news) > 0)
                        @foreach($news as $post)
                        <!-- single blog -->
                        <div class="ul-blog ul-blog-2 ul-blog-inner">
                            <div class="ul-blog-img">
                                @if($post->thumbnail)
                                    <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}">
                                @else
                                    <img src="assets/img/blog-b-1.jpg" alt="Blog Image">
                                @endif
                            </div>
                            <div class="ul-blog-txt">
                                <div class="ul-blog-infos">
                                    <!-- single info -->
                                    <div class="ul-blog-info">
                                        <span class="icon"><i class="flaticon-account"></i></span>
                                        <span class="text">Par RACED</span>
                                    </div>
                                    <!-- single info -->
                                    <div class="ul-blog-info">
                                        <span class="icon"><i class="flaticon-price-tag"></i></span>
                                        <span class="text">{{ $post->category->title ?? 'Actualité' }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('news.show', $post->slug) }}" class="ul-blog-title">{{ $post->title }}</a>
                                <p class="ul-blog-excerpt">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                <a href="{{ route('news.show', $post->slug) }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Lire plus</a>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center">
                            <p>Aucune actualité disponible pour le moment.</p>
                        </div>
                    @endif
                </div>

                <!-- pagination -->
                @if(isset($news) && method_exists($news, 'links'))
                <div class="ul-pagination">
                    <ul>
                        <li><a href="{{ $news->previousPageUrl() }}"><i class="flaticon-back"></i></a></li>
                        <li class="pages">
                            @for($i = 1; $i <= $news->lastPage(); $i++)
                                <a href="{{ $news->url($i) }}" class="{{ $i == $news->currentPage() ? 'active' : '' }}">{{ $i }}</a>
                            @endfor
                        </li>
                        <li><a href="{{ $news->nextPageUrl() }}"><i class="flaticon-next"></i></a></li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if(isset($pageSections) && count($pageSections) > 0)
    @foreach($pageSections as $pageSection)
        <x-dynamic-section :pageSection="$pageSection" />
    @endforeach
@endif
@endsection 