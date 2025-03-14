@extends('frontend.layouts.master')

@section('title', isset($settings) ? $settings->site_name : 'ONG Carrefour Jeunesse Afrique')

@section('content')
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
                <div class="swiper-slide">
                    <div class="ul-banner-2-slide">
                        <img src="{{ asset('assets/img/slider.jpg') }}" alt="Slide Background Image" class="ul-banner-2-slide-bg-img">
                        <div class="row gy-4 align-items-center">
                            <div class="col-md-7">
                                <div class="ul-banner-txt">
                                    <div class="wow animate__fadeInUp">
                                        <span class="ul-banner-sub-title ul-section-sub-title">CENTRE SOCIO - EDUCATIF D'AIDE A L'ENFANCE, L'ADOLESCENCE ET A LA JEUNESSE</span>
                                        <h1 class="ul-banner-title">Carrefour Jeunesse Afrique</h1>
                                        <div class="ul-banner-btns">
                                            <a href="{{ route('donation') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Nous soutenir</a>
                                            <a href="{{ route('contact') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Nous contacter</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="ul-banner-2-slide">
                        <img src="{{ asset('assets/img/slider2.jpg') }}" alt="Slide Background Image" class="ul-banner-2-slide-bg-img">
                        <div class="row gy-4 align-items-center">
                            <div class="col-md-7">
                                <div class="ul-banner-txt">
                                    <div class="wow animate__fadeInUp">
                                        <span class="ul-banner-sub-title ul-section-sub-title">Les formations professionnelles des jeunes vulnérables</span>
                                        <h1 class="ul-banner-title">Formations professionnelles et orientations</h1>
                                        <div class="ul-banner-btns">
                                            <a href="{{ route('donation') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Nous soutenir</a>
                                            <a href="{{ route('contact') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Nous contacter</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="ul-banner-2-slide">
                        <img src="{{ asset('assets/img/slider3.jpg') }}" alt="Slide Background Image" class="ul-banner-2-slide-bg-img">
                        <div class="row gy-4 align-items-center">
                            <div class="col-md-7">
                                <div class="ul-banner-txt">
                                    <div class="wow animate__fadeInUp">
                                        <span class="ul-banner-sub-title ul-section-sub-title">Protéger l'environnement, promouvoir l'éducation et la justice sociale</span>
                                        <h1 class="ul-banner-title">Un engagement citoyen pour un avenir durable</h1>
                                        <div class="ul-banner-btns">
                                            <a href="{{ route('donation') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Nous soutenir</a>
                                            <a href="{{ route('contact') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Nous contacter</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

<!-- FEATURES SECTION START -->
<section class="ul-features ul-section-spacing">
    <div class="ul-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="sec-title text-center mb-4">
                    <h1>Nos Valeurs</h1>
                    <div class="border-shape"></div>
                </div>
            </div>
        </div>
        <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4 justify-content-center">
            @if(isset($about) && $about->values)
                @php
                    $valuesHtml = $about->values;
                    $dom = new DOMDocument();
                    libxml_use_internal_errors(true);
                    $dom->loadHTML(mb_convert_encoding($valuesHtml, 'HTML-ENTITIES', 'UTF-8'));
                    libxml_clear_errors();
                    
                    $valuesList = $dom->getElementsByTagName('li');
                    $values = [];
                    
                    foreach ($valuesList as $item) {
                        $values[] = trim($item->textContent);
                    }
                @endphp
                
                @foreach($values as $value)
                    <!-- single feature -->
                    <div class="col">
                        <div class="ul-feature">
                            <div class="ul-feature-icon">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 0C8.05887 0 0 8.05887 0 18C0 27.9411 8.05887 36 18 36C27.9411 36 36 27.9411 36 18C36 8.05887 27.9411 0 18 0ZM18 32.4C10.0472 32.4 3.6 25.9528 3.6 18C3.6 10.0472 10.0472 3.6 18 3.6C25.9528 3.6 32.4 10.0472 32.4 18C32.4 25.9528 25.9528 32.4 18 32.4Z" fill="#EB5310"/>
                                    <path d="M25.2 13.5L16.2 22.5L10.8 17.1L8.1 19.8L16.2 27.9L27.9 16.2L25.2 13.5Z" fill="#EB5310"/>
                                </svg>
                            </div>
                            <h3 class="ul-feature-title">{{ $value }}</h3>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- FEATURES SECTION END -->


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

<!-- PROJECTS SECTION START -->
<section class="ul-projects ul-section-spacing">
    <div class="ul-container">
        <div class="ul-section-heading text-center justify-content-center">
            <div>
                <span class="ul-section-sub-title">Nos réalisations</span>
                <h2 class="ul-section-title">Nos projets pour améliorer la vie des enfants</h2>
            </div>
        </div>

        @if(isset($projects) && count($projects) > 0)
        <div class="row ul-bs-row justify-content-center">
            @foreach($projects->take(4) as $key => $project)
                @if($key == 0 || $key == 3)
                <div class="col-lg-8 col-md-6 col-10 col-xxs-12">
                    <div class="ul-project">
                        <div class="ul-project-img">
                            <img src="{{ asset($project->image ?? 'assets/img/project-1.jpg') }}" alt="{{ $project->title }}">
                        </div>
                        <div class="ul-project-txt">
                            <div>
                                <h3 class="ul-project-title"><a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a></h3>
                                <p class="ul-project-descr">{{ Str::limit(strip_tags($project->short_description), 60) }}</p>
                            </div>
                            <a href="{{ route('projects.show', $project->slug) }}" class="ul-project-btn"><i class="flaticon-up-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-lg-4 col-md-6 col-10 col-xxs-12">
                    <div class="ul-project ul-project--sm">
                        <div class="ul-project-img">
                            <img src="{{ asset($project->image ?? 'assets/img/project-2.jpg') }}" alt="{{ $project->title }}">
                        </div>
                        <div class="ul-project-txt">
                            <div>
                                <h3 class="ul-project-title"><a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a></h3>
                                <p class="ul-project-descr">{{ Str::limit(strip_tags($project->short_description), 40) }}</p>
                            </div>
                            <a href="{{ route('projects.show', $project->slug) }}" class="ul-project-btn"><i class="flaticon-up-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        @else
        <div class="row ul-bs-row justify-content-center">
            <div class="col-md-12">
                <p class="text-center">Aucun projet disponible pour le moment.</p>
            </div>
        </div>
        @endif
        
        <div class="text-center mt-4">
            <a href="{{ route('projects.index') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Voir tous nos projets</a>
        </div>
    </div>
</section>
<!-- PROJECTS SECTION END -->

<!-- BENEVOL SECTION START -->
<section class="ul-contact">
	<div class="ul-container">
		<div class="row g-0">
			<div class="col-lg-5">
				<div class="ul-contact-img">
					<img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image">
				</div>
			</div>

			<!-- form -->
			<div class="col-lg-7">
				<div class="ul-contact-form-wrapper">
					<span class="ul-section-sub-title">Agir avec nous dès maintenant</span>
					<h2 class="ul-section-title">Devenez Bénévole ou volontaire -> Devenez partenaires</h2>

					<form action="{{ route('benevole.store') }}" class="ul-contact-form" method="POST">
					@csrf
						<div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
							<div class="col">
								<div class="form-group">
									<input type="text" name="name" id="ul-contact-name" placeholder="Nom">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<input type="text" name="prenom" id="ul-contact-name" placeholder="Prénom">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<input type="email" name="email" id="ul-contact-email" placeholder="Email">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<input type="tel" name="phone" id="ul-contact-phone" placeholder="Téléphone">
								</div>
							</div>
							
							<div class="col-12">
								<button class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Envoyer</button>
							</div>
						</div>
						@if(session('success'))
						<div class="col">
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						</div>
					@endif
					@error('name')
						<div class="col">
							<div class="alert alert-danger">
								{{ $message }}
							</div>
						</div>
					@enderror
					@error('prenom')
						<div class="col">
							<div class="alert alert-danger">
								{{ $message }}
							</div>
						</div>
					@enderror
					@error('email')
						<div class="col">
							<div class="alert alert-danger">
								{{ $message }}
							</div>
						</div>
					@enderror
					@error('phone')
						<div class="col">
							<div class="alert alert-danger">
								{{ $message }}
							</div>
						</div>
					@enderror
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- BENEVOL SECTION END -->

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


<!-- CTA(CALL TO ACTION) SECTION START -->
<!-- <section class="ul-cta">
	<div class="ul-container">
		<span class="ul-section-sub-title text-white">Agir avec nous dès maintenant</span>
		<h2 class="ul-cta-title">Faire un don -> Devenez Bénévole ou volontaire -> Devenez partenaires</h2>
		<a href="{{ route('donation') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Faire un don</a>
	</div>
	<img src="assets/img/about_shape2_1.png" alt="Vector" class="ul-cta-vector">
</section> -->
<!-- CTA(CALL TO ACTION) SECTION END -->

<!-- Stats -->
@include('frontend.layouts.partials.stats')	

<!-- Partenaires -->
@include('frontend.layouts.partials.partners')
@endsection