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