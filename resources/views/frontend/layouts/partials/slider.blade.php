<!-- BANNER SECTION START -->
<section class="ul-banner ul-banner-2">
    <div class="ul-banner-2-slider swiper">
        <div class="swiper-wrapper">
            @forelse($sliders ?? [] as $slider)
                @if($slider->status == 1)
                    <div class="swiper-slide">
                        <div class="ul-banner-2-slide">
                            <img src="{{ asset('storage/' . $slider->image) }}" alt="Slide Background Image" class="ul-banner-2-slide-bg-img">
                            <div class="row gy-4 align-items-center">
                                <div class="col-md-7">
                                    <div class="ul-banner-txt">
                                        <div class="wow animate__fadeInUp">
                                            @if($slider->subtitle)
                                                <span class="ul-banner-sub-title ul-section-sub-title">{{ $slider->subtitle }}</span>
                                            @endif
                                            <h1 class="ul-banner-title">{{ $slider->title }}</h1>
                                            <div class="ul-banner-btns">
                                                @if($slider->button_text && $slider->button_link)
                                                    <a href="{{ $slider->button_link }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ $slider->button_text }}</a>
                                                @endif
                                                @if($slider->button_text_2 && $slider->button_link_2)
                                                    <a href="{{ $slider->button_link_2 }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ $slider->button_text_2 }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
            @endforelse
        </div>
    </div>

    <!-- slider navigation -->
    <div class="ul-banner-2-slider-navigation">
        <button class="prev"><img src="{{ asset('assets/img/left-arrow.svg') }}" alt="arrow"></button>
        <div class="ul-banner-2-thumb-slider swiper">
            <div class="swiper-wrapper">
                @forelse($sliders ?? [] as $slider)
                    @if($slider->status == 1)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $slider->image) }}" alt="Banner Thumb">
                        </div>
                    @endif
                @empty
                    <div class="swiper-slide"><img src="{{ asset('assets/img/slider.jpg') }}" alt="Banner Thumb"></div>
                    <div class="swiper-slide"><img src="{{ asset('assets/img/slider2.jpg') }}" alt="Banner Thumb"></div>
                    <div class="swiper-slide"><img src="{{ asset('assets/img/slider3.jpg') }}" alt="Banner Thumb"></div>
                @endforelse
            </div>
        </div>
        <button class="next"><img src="{{ asset('assets/img/right-arrow.svg') }}" alt="arrow"></button>
    </div>
</section>
<!-- BANNER SECTION END -->