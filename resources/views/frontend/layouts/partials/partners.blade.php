<!-- Partners Section Start -->
<section class="ul-partners-section ul-section-spacing">
    <div class="ul-container">
        <div class="ul-section-heading">
            <div class="left">
                <span class="ul-section-sub-title">Collaborations</span>
                <h2 class="ul-section-title">Nos partenaires</h2>
                <p class="ul-section-descr">Découvrez les organisations qui nous soutiennent dans notre mission</p>
            </div>
        </div>
        
        <div class="ul-partners-slider swiper">
            <div class="swiper-wrapper">
                @foreach($partners ?? [] as $partner)
                    <div class="swiper-slide ul-partner-item">
                        <a href="{{ $partner->url ?? '#' }}" target="_blank" class="ul-partner-link" title="{{ $partner->name }}">
                            <img src="{{ asset('storage/partners/' . $partner->image) }}" alt="{{ $partner->name }}" class="ul-partner-img"/>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination ul-partners-pagination"></div>
        </div>
    </div>
</section>

<style>
    .ul-partners-section {
        background-color: var(--ul-c4);
    }
    
    .ul-partners-slider {
        padding: clamp(30px, 3.15vw, 60px) 0 clamp(40px, 4.2vw, 80px);
    }
    
    .ul-partner-item {
        height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.4s ease;
    }
    
    .ul-partner-item:hover {
        transform: translateY(-10px);
    }
    
    .ul-partner-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: clamp(15px, 1.58vw, 30px);
        border-radius: 15px;
        background-color: var(--white);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        height: 100%;
        width: 100%;
        transition: all 0.4s ease;
    }
    
    .ul-partner-link:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        background-color: rgba(250, 242, 25, 0.05);
        border: 1px solid var(--ul-primary);
    }
    
    .ul-partner-img {
        max-width: 100%;
        height: clamp(60px, 6.31vw, 120px);
        object-fit: contain;
        margin-bottom: clamp(10px, 0.79vw, 15px);
        filter: grayscale(100%);
        transition: filter 0.4s ease;
    }
    
    .ul-partner-link:hover .ul-partner-img {
        filter: grayscale(0%);
    }
    
    .ul-partners-slider:hover .ul-partner-item {
        animation: partnerWiggle 0.8s infinite alternate;
    }
    
    .ul-partners-slider:hover .ul-partner-item:nth-child(odd) {
        animation-delay: 0.2s;
    }
    
    .ul-partners-slider:hover .ul-partner-item:nth-child(3n) {
        animation-delay: 0.4s;
    }
    
    .ul-partners-slider:hover .ul-partner-item:nth-child(3n+1) {
        animation-delay: 0.6s;
    }
    
    @keyframes partnerWiggle {
        0% {
            transform: translateY(0) rotate(0deg);
        }
        25% {
            transform: translateY(-5px) rotate(-2deg);
        }
        50% {
            transform: translateY(0) rotate(0deg);
        }
        75% {
            transform: translateY(-5px) rotate(2deg);
        }
        100% {
            transform: translateY(0) rotate(0deg);
        }
    }
    
    .ul-partner-name {
        font-family: var(--font-quicksand);
        font-weight: 600;
        font-size: clamp(14px, 0.89vw, 17px);
        color: var(--ul-black);
        margin-top: auto;
    }
    
    .ul-partners-pagination {
        position: static;
        margin-top: clamp(20px, 2.1vw, 40px);
    }
    
    .ul-partners-pagination .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background-color: var(--ul-gray2);
        opacity: 1;
    }
    
    .ul-partners-pagination .swiper-pagination-bullet-active {
        background-color: var(--ul-primary);
        width: 30px;
        border-radius: 5px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const partnersSlider = new Swiper('.ul-partners-slider', {
            slidesPerView: 2,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.ul-partners-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                },
            }
        });
        
        // Pause autoplay when hovering to allow animation effects to be visible
        const sliderEl = document.querySelector('.ul-partners-slider');
        if (sliderEl) {
            sliderEl.addEventListener('mouseenter', function() {
                partnersSlider.autoplay.stop();
            });
            
            sliderEl.addEventListener('mouseleave', function() {
                partnersSlider.autoplay.start();
            });
        }
    });
</script>
<!-- Partners Section End -->