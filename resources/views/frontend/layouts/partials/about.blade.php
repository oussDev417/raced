<!-- ABOUT SECTION START -->
<section class="ul-about ul-about-2 ul-section-spacing wow animate__fadeInUp">
    <div class="ul-container">
        <div class="row row-cols-md-2 row-cols-1 align-items-center gy-4 ul-about-row">
            <div class="col">
                <div class="ul-about-imgs ul-about-2-img">
                    <div class="img-wrapper">
                        <img src="{{ asset($about->main_image ?? 'img/enfant-maire.jpeg') }}" alt="Image">
                    </div>

                    <div class="ul-about-2-stat">
                        <span class="number">15+</span>
                        <span class="txt">Années d'existence</span>
                    </div>
                </div>
            </div>

            <!-- txt -->
            <div class="col">
                <div class="ul-about-txt">
                    <span class="ul-section-sub-title ul-section-sub-title--2">À propos de nous</span>
                    <h2 class="ul-section-title">{{ $about->subtitle ?? 'Nous croyons en un avenir meilleur pour les enfants et les jeunes.' }}</h2>
                    <p class="ul-section-descr">{{ $about->short_description ?? 'Nous sommes une organisation non gouvernementale dédiée à l\'amélioration des conditions de vie des enfants et des jeunes en Afrique.' }}</p>

                    <div class="ul-about-bottom ul-about-2-bottom">
                        <div class="ul-about-2-bottom-block">
                            <div class="ul-about-2-bottom-block-icon"><img src="{{ asset('assets/img/mission.svg') }}" alt="icon"></div>
                            <div class="ul-about-2-bottom-block-txt">
                                <h3 class="ul-about-2-bottom-block-title">Notre Mission</h3>
                                <p class="ul-about-2-bottom-block-descr">{!! Str::limit($about->mission ?? '<span style="color: rgb(51, 51, 51);">Soutenir les enfants et les jeunes en difficulté</span>', 100) !!}</p>
                            </div>
                        </div>

                        <div class="ul-about-2-bottom-block">
                            <div class="ul-about-2-bottom-block-icon"><img src="{{ asset('assets/img/vision.svg') }}" alt="icon"></div>
                            <div class="ul-about-2-bottom-block-txt">
                                <h3 class="ul-about-2-bottom-block-title">Notre Vision</h3>
                                <p class="ul-about-2-bottom-block-descr">{!! Str::limit($about->vision ?? '<span style="color: rgb(51, 51, 51);">Créer un monde où chaque enfant a accès à l\'éducation</span>', 100) !!}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> En savoir plus</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ABOUT SECTION END -->