<!-- SERVICES SECTION START -->
<section class="ul-services ul-section-spacing overflow-hidden">
    <div class="ul-container">
        <div class="ul-section-heading">
            <div>
                <span class="ul-section-sub-title">Ensemble, nous pouvons changer des vies.</span>
                <h2 class="ul-section-title">Nos opportunités</h2>
            </div>

            <div class="ul-services-slider-nav ul-slider-nav position-static">
                <button class="prev"><i class="flaticon-back"></i></button>
                <button class="next"><i class="flaticon-next"></i></button>
            </div>
        </div>

        @if(isset($axes) && count($axes) > 0)
        <div class="ul-services-slider swiper overflow-visible">
            <div class="swiper-wrapper">
                @foreach($axes as $axe)
                <!-- single slide -->
                <div class="swiper-slide">
                    <div class="ul-service">
                        <div class="ul-service-img">
                            <img src="{{ asset('storage/axes/' . ($axe->image ?? 'default.jpg')) }}" alt="{{ $axe->title }}">
                        </div>
                        <div class="ul-service-txt">
                            <h3 class="ul-service-title"><a href="{{ route('axes.show', $axe->slug) }}">{{ $axe->title }}</a></h3>
                            <p class="ul-service-descr">{{ $axe->short_description ?? 'Découvrez nos actions dans cet axe stratégique pour améliorer les conditions de vie.' }}</p>
                            <a href="{{ route('axes.show', $axe->slug) }}" class="ul-service-btn"><i class="flaticon-up-right-arrow"></i> Voir détails</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
<!-- SERVICES SECTION END -->