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

<!-- Gallery Section Start -->
<section class="ul-gallery-section ul-section-spacing">
    <div class="ul-container">
        <div class="ul-section-header text-center">
            <h2 class="ul-section-title">Notre galerie d'images</h2>
            <div class="ul-section-title-divider"></div>
            <p class="ul-section-subtitle">Découvrez nos moments forts en images</p>
        </div>
        
        <div class="ul-gallery-filter">
            <ul class="ul-gallery-filter-nav">
                <li class="active" data-filter="*">Tout</li>
                @foreach($galleryCategories as $category)
                    <li data-filter=".{{ Str::slug($category->name) }}">{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
        
        <div class="ul-gallery-grid">
            @foreach($gallery as $item)
                <div class="ul-gallery-item {{ Str::slug($item->category->name) }}">
                    <div class="ul-gallery-item-inner">
                        @if($item->path)
                            <img src="{{ asset($item->path) }}" alt="{{ $item->title }}" />
                            <div class="ul-gallery-overlay">
                                <div class="ul-gallery-actions">
                                    <a href="{{ asset($item->path) }}" class="ul-gallery-zoom"><i class="flaticon-search"></i></a>
                                </div>
                                <h3 class="ul-gallery-title">{{ $item->title }}</h3>
                                <p class="ul-gallery-category">{{ $item->category->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Gallery Section End -->

<style>
/* Styles pour la galerie */
.ul-gallery-section {
    background-color: #f9f9f9;
}

.ul-section-header {
    margin-bottom: 50px;
}

.ul-section-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #222;
}

.ul-section-title-divider {
    width: 80px;
    height: 3px;
    background-color: var(--ul-primary);
    margin: 0 auto 20px;
}

.ul-section-subtitle {
    font-size: 16px;
    color: #666;
    max-width: 700px;
    margin: 0 auto;
}

.ul-gallery-filter {
    margin-bottom: 30px;
    text-align: center;
}

.ul-gallery-filter-nav {
    display: inline-flex;
    flex-wrap: wrap;
    justify-content: center;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 10px;
}

.ul-gallery-filter-nav li {
    padding: 8px 20px;
    cursor: pointer;
    font-weight: 500;
    border-radius: 30px;
    transition: all 0.3s ease;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.ul-gallery-filter-nav li.active,
.ul-gallery-filter-nav li:hover {
    background-color: var(--ul-primary);
    color: #fff;
}

.ul-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.ul-gallery-item {
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
}

.ul-gallery-item:hover {
    transform: translateY(-5px);
}

.ul-gallery-item-inner {
    position: relative;
    overflow: hidden;
    aspect-ratio: 4/3;
}

.ul-gallery-item-inner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.ul-gallery-item:hover .ul-gallery-item-inner img {
    transform: scale(1.1);
}

.ul-gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    padding: 20px;
    text-align: center;
}

.ul-gallery-item:hover .ul-gallery-overlay {
    opacity: 1;
}

.ul-gallery-actions {
    margin-bottom: 15px;
}

.ul-gallery-zoom {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    background-color: var(--ul-primary);
    color: #fff;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.ul-gallery-zoom:hover {
    background-color: #fff;
    color: var(--ul-primary);
}

.ul-gallery-title {
    color: #fff;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 5px;
}

.ul-gallery-category {
    color: rgba(255, 255, 255, 0.8);
    font-size: 14px;
}

@media (max-width: 768px) {
    .ul-gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
    
    .ul-section-title {
        font-size: 28px;
    }
}

@media (max-width: 576px) {
    .ul-gallery-grid {
        grid-template-columns: 1fr;
    }
    
    .ul-gallery-filter-nav {
        gap: 5px;
    }
    
    .ul-gallery-filter-nav li {
        padding: 6px 15px;
        font-size: 14px;
    }
}
</style>

@endsection 