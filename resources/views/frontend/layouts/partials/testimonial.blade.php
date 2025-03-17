<!-- TESTIMONIAL SECTION START -->
<section class="ul-testimonial-2 ul-section-spacing">
    <div class="ul-container wow animate__fadeInUp">
        <div class="ul-section-heading">
            <div>
                <span class="ul-section-sub-title">Témoignages</span>
                <h2 class="ul-section-title">Ce que les gens disent de nous</h2>
            </div>
            <a href="#" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Tous les témoignages</a>
        </div>

        <div class="row ul-testimonial-2-row gy-4">
            <!-- card -->
            <div class="col-md-4">
                <div class="ul-testimonial-2-overview">
                    <span class="rating">4.9</span>
                    <div class="ul-testimonial-2-overview-stars">
                        <i class="flaticon-star"></i>
                        <i class="flaticon-star"></i>
                        <i class="flaticon-star"></i>
                        <i class="flaticon-star"></i>
                        <i class="flaticon-star-1"></i>
                    </div>
                    <span class="ul-testimonial-2-overview-title">5 étoiles</span>
                    <p class="ul-testimonial-2-overview-descr">Découvrez ce que nos clients et partenaires disent de notre travail et de notre engagement.</p>
                    <div class="ul-testimonial-2-overview-reviewers">
                        @if(isset($testimonials) && $testimonials->count() > 0)
                            @foreach($testimonials->take(4) as $reviewer)
                                <img src="{{ asset('storage/testimonials/' . $reviewer->image) }}" alt="{{ $reviewer->name }}">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- txt -->
            <div class="col-md-8">
                <div class="ul-testimonial-2-slider swiper">
                    <div class="swiper-wrapper">
                        @if(isset($testimonials) && $testimonials->count() > 0)
                            @foreach($testimonials as $testimonial)
                                <!-- single slide -->
                                <div class="swiper-slide">
                                    <div class="ul-review ul-review-2">
                                        <span class="icon"><i class="flaticon-quote-1"></i></span>
                                        <p class="ul-review-descr">{{ $testimonial->message }}</p>
                                        <div class="ul-review-bottom">
                                            <div class="ul-review-reviewer">
                                                <div class="reviewer-image">
                                                    <img src="{{ asset('storage/testimonials/' . $testimonial->image) }}" alt="{{ $testimonial->name }}">
                                                </div>
                                                <div>
                                                    <h3 class="reviewer-name">{{ $testimonial->name }}</h3>
                                                    <span class="reviewer-role">{{ $testimonial->position }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="ul-testimonial-2-slider-nav">
                        <button class="prev"><i class="flaticon-back"></i></button>
                        <button class="next"><i class="flaticon-next"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- TESTIMONIAL SECTION END -->