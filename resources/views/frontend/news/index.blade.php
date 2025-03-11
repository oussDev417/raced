@extends('frontend.layouts.master')

@section('title', 'Actualités')

@section('content')

<!-- Page Heading Section Start -->	
<div class="pagehding-sec">
    <div class="images-overlay"></div>		
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>Nos actualités</h1>
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
                        <li><a href="#">Nos actualités</a></li>
                    </ul>
                </div>
            </div>	
        </div>
    </div>
</div>
<!-- Page Heading Section End -->

<!-- Blog Section Start -->
<div class="blog-sec pt-100">
    <div class="container">			
        <div class="row">	
            <div class="sec-title">
                <h1>Nos actualités</h1>
                <div class="border-shape"></div>
            </div>
            @if(isset($news) && count($news) > 0)
                @foreach($news as $post)							
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">	
                    <div class="media">	
                        <div class="single-post">	
                            @if($post->thumbnail)
                                <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}"/>
                            @endif												
                            <div class="media-body">
                                <div class="single-post-text">
                                    <div class="post-info">
                                        <div class="post-meta">
                                            <ul>
                                                <li><span>posté par</span><a href="#">CJA</a></li>
                                                <li><span>posté le</span><a href="#">{{ $post->created_at->format('d M Y') }}</a></li>
                                            </ul>									
                                        </div>																			
                                    </div>	
                                    <h2><a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a></h2>									
                                    <p>{{ Str::limit(strip_tags($post->short_description), 200) }}</p>
                                    <a href="{{ route('news.show', $post->slug) }}" class="post-link">Voir plus</a>						
                                </div>
                            </div>
                        </div>				
                    </div>				
                </div>
                @endforeach
                
                <!-- Pagination -->
                @if(method_exists($news, 'links'))
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="pagination-area">
                                {{ $news->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            @endif		
        </div>
    </div>
</div>
<!-- Blog Section End -->

<!-- Gallery Section Start -->
<div class="gallery-full-sec pt-100 pb-100">	
    <div class="blog-gallery">	
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sec-title">
                        <h1>Galerie d'images</h1>
                        <div class="border-shape"></div>
                    </div>
                </div>
            </div>			
            <div class="collapse navbar-collapse" id="navbarfiltr">
                <ul class="simplefilter">
                    <li class="active" data-filter="*">Tout</li>
                    @foreach($galleryCategories as $category)
                        <li data-filter=".{{ Str::slug($category->name) }}">{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="filtr-container">
                @foreach($gallery as $item)	
                    <div class="inner filtr-item {{ Str::slug($item->category->name) }}">
                        <div class="gallery-item">
                            @if($item->path)
                                <img src="{{ asset($item->path) }}" alt="{{ $item->title }}" />
                                <div class="gallery-overlay">
                                    <ul>
                                        <li><a href="{{ asset($item->path) }}" class="gallery-photo"><i class="fa fa-search-plus"></i></a></li>
                                    </ul>
                                    <h2>{{ $item->title }}</h2>		
                                </div>
                            @endif
                        </div>						
                    </div>
                @endforeach												
            </div>					
        </div>
    </div>
</div>
<!-- Gallery Section End -->

@endsection 