<!-- BLOG SECTION START -->
<section class="ul-blogs-2 ul-section-spacing">
    <div class="ul-container wow animate__fadeInUp">
        <div class="ul-section-heading">
            <div class="left">
                <span class="ul-section-sub-title">Actualités</span>
                <h2 class="ul-section-title">Nos dernières nouvelles</h2>
            </div>

            <a href="{{ route('news.index') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Toutes les actualités</a>
        </div>

        <div class="row row-cols-md-3 row-cols-2 row-cols-xxs-1 ul-bs-row justify-content-center">
            @if(isset($news) && count($news) > 0)
                @foreach($news as $post)
                <!-- single blog -->
                <div class="col">
                    <div class="ul-blog ul-blog-2">
                        <div class="ul-blog-img">
                            @if($post->thumbnail)
                                <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}">
                            @else
                                <img src="assets/img/blog-1.jpg" alt="Blog Image">
                            @endif
                            <div class="date">
                                <span class="number">{{ $post->created_at->format('d') }}</span>
                                <span class="txt">{{ $post->created_at->format('M') }}</span>
                            </div>
                        </div>
                        <div class="ul-blog-txt">
                            <div class="ul-blog-infos">
                                <!-- single info -->
                                <div class="ul-blog-info">
                                    <span class="icon"><i class="flaticon-account"></i></span>
                                    <span class="text font-normal text-[14px] text-etGray">par RACED</span>
                                </div>
                                <!-- single info -->
                                <div class="ul-blog-info">
                                    <span class="icon"><i class="flaticon-price-tag"></i></span>
                                    <span class="text font-normal text-[14px] text-etGray">{{ $post->category->title ?? 'Actualité' }}</span>
                                </div>
                            </div>
                            <a href="{{ route('news.show', $post->slug) }}" class="ul-blog-title">{{ $post->title }}</a>
                            <a href="{{ route('news.show', $post->slug) }}" class="ul-blog-btn">Lire plus <span class="icon"><i class="flaticon-next"></i></span></a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p>Aucune actualité disponible pour le moment.</p>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        @if(isset($news) && method_exists($news, 'links'))
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="pagination-area">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- BLOG SECTION END -->